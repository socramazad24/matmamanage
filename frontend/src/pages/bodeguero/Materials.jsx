"use client"

import { useState, useEffect } from "react"
import Layout from "../../components/Layout"
import api from "../../services/api"

const BodegueroMaterials = () => {
  const [materials, setMaterials] = useState([])
  const [filteredMaterials, setFilteredMaterials] = useState([])
  const [loading, setLoading] = useState(true)
  const [searchTerm, setSearchTerm] = useState("")

  useEffect(() => {
    loadMaterials()
  }, [])

  useEffect(() => {
    filterMaterials()
  }, [searchTerm, materials])

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

  if (loading) {
    return (
      <Layout title="MAT-MANAGER - Bodeguero">
        <div className="flex items-center justify-center min-h-[60vh]">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-secondary"></div>
        </div>
      </Layout>
    )
  }

  return (
    <Layout title="MAT-MANAGER - Bodeguero">
      <div className="container mx-auto px-5 py-8">
        <div className="mb-6">
          <h2 className="text-3xl font-bold text-gray-900 mb-4">Materiales</h2>
          <input
            type="text"
            placeholder="Buscar materiales..."
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            className="input-field max-w-md"
          />
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {filteredMaterials.map((material) => (
            <div
              key={material.idMaterial}
              className="card p-6 hover:scale-105 transition-transform cursor-pointer uppercase"
            >
              <div className="flex items-center justify-between mb-4">
                <h3 className="text-2xl font-bold text-secondary">{material.MaterialName}</h3>
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
      </div>
    </Layout>
  )
}

export default BodegueroMaterials
