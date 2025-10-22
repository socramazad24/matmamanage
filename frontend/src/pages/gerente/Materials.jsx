"use client"

import { useState, useEffect } from "react"
import Layout from "../../components/Layout"
import api from "../../services/api"
import Modal from "../../components/Modal"

const Materials = () => {
  const [materials, setMaterials] = useState([])
  const [filteredMaterials, setFilteredMaterials] = useState([])
  const [loading, setLoading] = useState(true)
  const [searchTerm, setSearchTerm] = useState("")
  const [showModal, setShowModal] = useState(false)
  const [providers, setProviders] = useState([])
  const [formData, setFormData] = useState({
    MaterialName: "",
    Description: "",
    costoUnitario: "",
    cantidadMaterial: "",
    idProveedor: "",
  })

  useEffect(() => {
    loadMaterials()
    loadProviders()
  }, [])

  const loadMaterials = async () => {
    try {
      const response = await api.getMaterials()
      setMaterials(response.data || [])
      setFilteredMaterials(response.data || [])
    } catch (error) {
      console.error("Error loading materials:", error)
    } finally {
      setLoading(false)
    }
  }

  const loadProviders = async () => {
    try {
      const response = await api.getProviders()
      setProviders(response.data || [])
    } catch (error) {
      console.error("Error loading providers:", error)
    }
  }

  const filterMaterials = () => {
    if (!searchTerm) {
      setFilteredMaterials(materials)
      return
    }

    const filtered = materials.filter((material) =>
      Object.values(material).some((value) => String(value).toLowerCase().includes(searchTerm.toLowerCase())),
    )
    setFilteredMaterials(filtered)
  }

  const handleCreate = async (e) => {
    e.preventDefault()
    try {
      await api.createMaterial(formData)
      setShowModal(false)
      setFormData({
        MaterialName: "",
        Description: "",
        costoUnitario: "",
        cantidadMaterial: "",
        idProveedor: "",
      })
      loadMaterials()
      alert("Material creado exitosamente")
    } catch (error) {
      alert("Error al crear material: " + error.message)
    }
  }

  if (loading) {
    return (
      <Layout title="MAT-MANAGER - Materiales">
        <div className="flex items-center justify-center min-h-[60vh]">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-secondary"></div>
        </div>
      </Layout>
    )
  }

  return (
    <Layout title="MAT-MANAGER - Materiales">
      <div className="container mx-auto px-5 py-8">
        <div className="mb-6 flex items-center justify-between flex-wrap gap-4">
          <div className="flex-1 min-w-[250px]">
            <h2 className="text-3xl font-bold text-gray-900 mb-4">Materiales</h2>
            <input
              type="text"
              placeholder="Buscar materiales..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="input-field max-w-md"
            />
          </div>
          <button onClick={() => setShowModal(true)} className="btn-primary">
            + Nuevo Material
          </button>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {filteredMaterials.map((material) => (
            <div key={material.idMaterial} className="card p-6 hover:scale-105 transition-transform cursor-pointer">
              <div className="flex items-center justify-between mb-4">
                <h3 className="text-2xl font-bold text-secondary uppercase">{material.MaterialName}</h3>
                <span className="bg-gray-400 text-white px-3 py-2 rounded-full text-xl font-semibold">
                  {material.idMaterial}
                </span>
              </div>

              <div className="space-y-3">
                <div className="flex items-center justify-between">
                  <span className="text-sm font-semibold text-gray-500">Descripción</span>
                  <span className="bg-gray-200 px-4 py-2 rounded-full text-sm font-semibold text-gray-600">
                    {material.Description}
                  </span>
                </div>

                <div className="flex items-center justify-between">
                  <span className="text-sm font-semibold text-gray-500">Costo</span>
                  <span className="bg-gray-200 px-3 py-2 rounded-full text-sm font-semibold text-gray-600">
                    ${material.costoUnitario}
                  </span>
                </div>

                <div className="flex items-center justify-between">
                  <span className="text-sm font-semibold text-gray-500">Cantidad</span>
                  <span className="bg-gray-200 px-3 py-2 rounded-full text-sm font-semibold text-gray-600">
                    {material.cantidadMaterial}
                  </span>
                </div>

                <div className="flex items-center justify-between">
                  <span className="text-sm font-semibold text-gray-500">Proveedor</span>
                  <span className="bg-gray-200 px-3 py-2 rounded-full text-sm font-semibold text-gray-600">
                    {material.idProveedor}
                  </span>
                </div>

                <div className="flex items-center justify-between">
                  <span className="text-sm font-semibold text-gray-500">Fecha</span>
                  <span className="bg-gray-200 px-3 py-2 rounded-full text-sm font-semibold text-gray-600">
                    {material.date_reg}
                  </span>
                </div>
              </div>
            </div>
          ))}
        </div>

        {filteredMaterials.length === 0 && (
          <div className="text-center py-12 text-gray-500">No se encontraron materiales</div>
        )}

        <Modal isOpen={showModal} onClose={() => setShowModal(false)} title="Crear Nuevo Material">
          <form onSubmit={handleCreate} className="space-y-4">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Nombre del Material</label>
              <input
                type="text"
                required
                value={formData.MaterialName}
                onChange={(e) => setFormData({ ...formData, MaterialName: e.target.value })}
                className="input-field"
              />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
              <textarea
                required
                value={formData.Description}
                onChange={(e) => setFormData({ ...formData, Description: e.target.value })}
                className="input-field"
                rows="3"
              />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Costo Unitario</label>
              <input
                type="number"
                step="0.01"
                required
                value={formData.costoUnitario}
                onChange={(e) => setFormData({ ...formData, costoUnitario: e.target.value })}
                className="input-field"
              />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Cantidad</label>
              <input
                type="number"
                required
                value={formData.cantidadMaterial}
                onChange={(e) => setFormData({ ...formData, cantidadMaterial: e.target.value })}
                className="input-field"
              />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Proveedor</label>
              <select
                required
                value={formData.idProveedor}
                onChange={(e) => setFormData({ ...formData, idProveedor: e.target.value })}
                className="input-field"
              >
                <option value="">Seleccionar proveedor</option>
                {providers.map((provider) => (
                  <option key={provider.idProveedor} value={provider.idProveedor}>
                    {provider.nombreProveedor}
                  </option>
                ))}
              </select>
            </div>
            <div className="flex gap-3 pt-4">
              <button type="button" onClick={() => setShowModal(false)} className="btn-secondary flex-1">
                Cancelar
              </button>
              <button type="submit" className="btn-primary flex-1">
                Crear Material
              </button>
            </div>
          </form>
        </Modal>
      </div>
    </Layout>
  )
}

export default Materials
