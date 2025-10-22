"use client"

import { useState, useEffect } from "react"
import Layout from "../../components/Layout"
import api from "../../services/api"
import Modal from "../../components/Modal"

const Providers = () => {
  const [providers, setProviders] = useState([])
  const [filteredProviders, setFilteredProviders] = useState([])
  const [loading, setLoading] = useState(true)
  const [searchTerm, setSearchTerm] = useState("")
  const [showModal, setShowModal] = useState(false)
  const [formData, setFormData] = useState({
    nombreProveedor: "",
    telefono: "",
    email: "",
    direccion: "",
  })

  useEffect(() => {
    loadProviders()
  }, [])

  useEffect(() => {
    filterProviders()
  }, [searchTerm, providers])

  const loadProviders = async () => {
    try {
      const response = await api.getProviders()
      setProviders(response.data || [])
      setFilteredProviders(response.data || [])
    } catch (error) {
      console.error("Error loading providers:", error)
    } finally {
      setLoading(false)
    }
  }

  const filterProviders = () => {
    if (!searchTerm) {
      setFilteredProviders(providers)
      return
    }

    const filtered = providers.filter((provider) =>
      Object.values(provider).some((value) => String(value).toLowerCase().includes(searchTerm.toLowerCase())),
    )
    setFilteredProviders(filtered)
  }

  const handleCreate = async (e) => {
    e.preventDefault()
    try {
      await api.createProvider(formData)
      setShowModal(false)
      setFormData({ nombreProveedor: "", telefono: "", email: "", direccion: "" })
      loadProviders()
      alert("Proveedor creado exitosamente")
    } catch (error) {
      alert("Error al crear proveedor: " + error.message)
    }
  }

  if (loading) {
    return (
      <Layout title="MAT-MANAGER - Proveedores">
        <div className="flex items-center justify-center min-h-[60vh]">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-secondary"></div>
        </div>
      </Layout>
    )
  }

  return (
    <Layout title="MAT-MANAGER - Proveedores">
      <div className="container mx-auto px-5 py-8">
        <div className="mb-6 flex items-center justify-between flex-wrap gap-4">
          <div className="flex-1 min-w-[250px]">
            <h2 className="text-3xl font-bold text-gray-900 mb-4">Proveedores</h2>
            <input
              type="text"
              placeholder="Buscar proveedores..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="input-field max-w-md"
            />
          </div>
          <button onClick={() => setShowModal(true)} className="btn-primary">
            + Nuevo Proveedor
          </button>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {filteredProviders.map((provider) => (
            <div key={provider.idProveedor} className="card p-6">
              <h3 className="text-xl font-bold text-secondary mb-2">{provider.nombreProveedor}</h3>
              <div className="space-y-2 text-sm text-gray-600">
                <p>
                  <span className="font-semibold">ID:</span> {provider.idProveedor}
                </p>
                <p>
                  <span className="font-semibold">Teléfono:</span> {provider.telefono}
                </p>
                <p>
                  <span className="font-semibold">Email:</span> {provider.email}
                </p>
                <p>
                  <span className="font-semibold">Dirección:</span> {provider.direccion}
                </p>
              </div>
            </div>
          ))}
        </div>

        {filteredProviders.length === 0 && (
          <div className="text-center py-12 text-gray-500">No se encontraron proveedores</div>
        )}

        <Modal isOpen={showModal} onClose={() => setShowModal(false)} title="Crear Nuevo Proveedor">
          <form onSubmit={handleCreate} className="space-y-4">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
              <input
                type="text"
                required
                value={formData.nombreProveedor}
                onChange={(e) => setFormData({ ...formData, nombreProveedor: e.target.value })}
                className="input-field"
              />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
              <input
                type="tel"
                required
                value={formData.telefono}
                onChange={(e) => setFormData({ ...formData, telefono: e.target.value })}
                className="input-field"
              />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Email</label>
              <input
                type="email"
                required
                value={formData.email}
                onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                className="input-field"
              />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Dirección</label>
              <textarea
                required
                value={formData.direccion}
                onChange={(e) => setFormData({ ...formData, direccion: e.target.value })}
                className="input-field"
                rows="3"
              />
            </div>
            <div className="flex gap-3 pt-4">
              <button type="button" onClick={() => setShowModal(false)} className="btn-secondary flex-1">
                Cancelar
              </button>
              <button type="submit" className="btn-primary flex-1">
                Crear Proveedor
              </button>
            </div>
          </form>
        </Modal>
      </div>
    </Layout>
  )
}

export default Providers
