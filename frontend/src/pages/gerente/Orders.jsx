"use client"

import { useState, useEffect } from "react"
import Layout from "../../components/Layout"
import api from "../../services/api"
import Modal from "../../components/Modal"

const Orders = () => {
  const [orders, setOrders] = useState([])
  const [filteredOrders, setFilteredOrders] = useState([])
  const [loading, setLoading] = useState(true)
  const [searchTerm, setSearchTerm] = useState("")
  const [showModal, setShowModal] = useState(false)
  const [materials, setMaterials] = useState([])
  const [formData, setFormData] = useState({
    idMaterial: "",
    cantidad: "",
    estado: "Pendiente",
  })

  useEffect(() => {
    loadOrders()
    loadMaterials()
  }, [])

  const loadOrders = async () => {
    try {
      const response = await api.getOrders()
      setOrders(response.data || [])
      setFilteredOrders(response.data || [])
    } catch (error) {
      console.error("Error loading orders:", error)
    } finally {
      setLoading(false)
    }
  }

  const loadMaterials = async () => {
    try {
      const response = await api.getMaterials()
      setMaterials(response.data || [])
    } catch (error) {
      console.error("Error loading materials:", error)
    }
  }

  const filterOrders = () => {
    if (!searchTerm) {
      setFilteredOrders(orders)
      return
    }

    const filtered = orders.filter((order) =>
      Object.values(order).some((value) => String(value).toLowerCase().includes(searchTerm.toLowerCase())),
    )
    setFilteredOrders(filtered)
  }

  const handleCreate = async (e) => {
    e.preventDefault()
    try {
      await api.createOrder(formData)
      setShowModal(false)
      setFormData({ idMaterial: "", cantidad: "", estado: "Pendiente" })
      loadOrders()
      alert("Pedido creado exitosamente")
    } catch (error) {
      alert("Error al crear pedido: " + error.message)
    }
  }

  if (loading) {
    return (
      <Layout title="MAT-MANAGER - Pedidos">
        <div className="flex items-center justify-center min-h-[60vh]">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-secondary"></div>
        </div>
      </Layout>
    )
  }

  return (
    <Layout title="MAT-MANAGER - Pedidos">
      <div className="container mx-auto px-5 py-8">
        <div className="mb-6 flex items-center justify-between flex-wrap gap-4">
          <div className="flex-1 min-w-[250px]">
            <h2 className="text-3xl font-bold text-gray-900 mb-4">Pedidos</h2>
            <input
              type="text"
              placeholder="Buscar pedidos..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="input-field max-w-md"
            />
          </div>
          <button onClick={() => setShowModal(true)} className="btn-primary">
            + Nuevo Pedido
          </button>
        </div>

        <div className="bg-white rounded-xl shadow-md overflow-hidden">
          <div className="overflow-x-auto">
            <table className="min-w-full divide-y divide-gray-200">
              <thead className="bg-gray-50">
                <tr>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    ID Pedido
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Material
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Cantidad
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Estado
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Fecha
                  </th>
                </tr>
              </thead>
              <tbody className="bg-white divide-y divide-gray-200">
                {filteredOrders.map((order, index) => (
                  <tr key={order.idPedido || index} className="hover:bg-gray-50">
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{order.idPedido}</td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{order.idMaterial}</td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{order.cantidad}</td>
                    <td className="px-6 py-4 whitespace-nowrap">
                      <span className="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        {order.estado || "Pendiente"}
                      </span>
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{order.fecha}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>

        {filteredOrders.length === 0 && (
          <div className="text-center py-12 text-gray-500">No se encontraron pedidos</div>
        )}

        <Modal isOpen={showModal} onClose={() => setShowModal(false)} title="Crear Nuevo Pedido">
          <form onSubmit={handleCreate} className="space-y-4">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Material</label>
              <select
                required
                value={formData.idMaterial}
                onChange={(e) => setFormData({ ...formData, idMaterial: e.target.value })}
                className="input-field"
              >
                <option value="">Seleccionar material</option>
                {materials.map((material) => (
                  <option key={material.idMaterial} value={material.idMaterial}>
                    {material.MaterialName} - {material.Description}
                  </option>
                ))}
              </select>
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Cantidad</label>
              <input
                type="number"
                required
                min="1"
                value={formData.cantidad}
                onChange={(e) => setFormData({ ...formData, cantidad: e.target.value })}
                className="input-field"
              />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Estado</label>
              <select
                value={formData.estado}
                onChange={(e) => setFormData({ ...formData, estado: e.target.value })}
                className="input-field"
              >
                <option value="Pendiente">Pendiente</option>
                <option value="En Proceso">En Proceso</option>
                <option value="Completado">Completado</option>
                <option value="Cancelado">Cancelado</option>
              </select>
            </div>
            <div className="flex gap-3 pt-4">
              <button type="button" onClick={() => setShowModal(false)} className="btn-secondary flex-1">
                Cancelar
              </button>
              <button type="submit" className="btn-primary flex-1">
                Crear Pedido
              </button>
            </div>
          </form>
        </Modal>
      </div>
    </Layout>
  )
}

export default Orders
