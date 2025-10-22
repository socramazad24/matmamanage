"use client"

import { useState, useEffect } from "react"
import Layout from "../../components/Layout"
import api from "../../services/api"
import Modal from "../../components/Modal"

const Users = () => {
  const [users, setUsers] = useState([])
  const [filteredUsers, setFilteredUsers] = useState([])
  const [loading, setLoading] = useState(true)
  const [searchTerm, setSearchTerm] = useState("")
  const [showModal, setShowModal] = useState(false)
  const [formData, setFormData] = useState({
    username: "",
    password: "",
    role: "bodeguero",
  })

  useEffect(() => {
    loadUsers()
  }, [])

  useEffect(() => {
    filterUsers()
  }, [searchTerm, users])

  const loadUsers = async () => {
    try {
      const response = await api.getUsers()
      setUsers(response.data || [])
      setFilteredUsers(response.data || [])
    } catch (error) {
      console.error("Error loading users:", error)
    } finally {
      setLoading(false)
    }
  }

  const filterUsers = () => {
    if (!searchTerm) {
      setFilteredUsers(users)
      return
    }

    const filtered = users.filter((user) =>
      Object.values(user).some((value) => String(value).toLowerCase().includes(searchTerm.toLowerCase())),
    )
    setFilteredUsers(filtered)
  }

  const handleDelete = async (idEmployee) => {
    if (!confirm("¿Está seguro de eliminar este usuario?")) return

    try {
      await api.deleteUser(idEmployee)
      loadUsers()
    } catch (error) {
      alert("Error al eliminar usuario")
    }
  }

  const handleCreate = async (e) => {
    e.preventDefault()
    try {
      await api.createUser(formData)
      setShowModal(false)
      setFormData({ username: "", password: "", role: "bodeguero" })
      loadUsers()
      alert("Usuario creado exitosamente")
    } catch (error) {
      alert("Error al crear usuario: " + error.message)
    }
  }

  if (loading) {
    return (
      <Layout title="MAT-MANAGER - Usuarios">
        <div className="flex items-center justify-center min-h-[60vh]">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-secondary"></div>
        </div>
      </Layout>
    )
  }

  return (
    <Layout title="MAT-MANAGER - Usuarios">
      <div className="container mx-auto px-5 py-8">
        <div className="mb-6 flex items-center justify-between flex-wrap gap-4">
          <div className="flex-1 min-w-[250px]">
            <h2 className="text-3xl font-bold text-gray-900 mb-4">Usuarios</h2>
            <input
              type="text"
              placeholder="Buscar usuarios..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="input-field max-w-md"
            />
          </div>
          <button onClick={() => setShowModal(true)} className="btn-primary">
            + Nuevo Usuario
          </button>
        </div>

        <div className="bg-white rounded-xl shadow-md overflow-hidden">
          <div className="overflow-x-auto">
            <table className="min-w-full divide-y divide-gray-200">
              <thead className="bg-gray-50">
                <tr>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Usuario
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nombre
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Rol
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Acciones
                  </th>
                </tr>
              </thead>
              <tbody className="bg-white divide-y divide-gray-200">
                {filteredUsers.map((user) => (
                  <tr key={user.idEmployee} className="hover:bg-gray-50">
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{user.idEmployee}</td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{user.username}</td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{user.name}</td>
                    <td className="px-6 py-4 whitespace-nowrap">
                      <span className="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-secondary text-white">
                        {user.role}
                      </span>
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <button onClick={() => handleDelete(user.idEmployee)} className="text-red-600 hover:text-red-900">
                        Eliminar
                      </button>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>

        {filteredUsers.length === 0 && (
          <div className="text-center py-12 text-gray-500">No se encontraron usuarios</div>
        )}

        <Modal isOpen={showModal} onClose={() => setShowModal(false)} title="Crear Nuevo Usuario">
          <form onSubmit={handleCreate} className="space-y-4">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Usuario</label>
              <input
                type="text"
                required
                value={formData.username}
                onChange={(e) => setFormData({ ...formData, username: e.target.value })}
                className="input-field"
              />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
              <input
                type="password"
                required
                value={formData.password}
                onChange={(e) => setFormData({ ...formData, password: e.target.value })}
                className="input-field"
              />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Rol</label>
              <select
                value={formData.role}
                onChange={(e) => setFormData({ ...formData, role: e.target.value })}
                className="input-field"
              >
                <option value="bodeguero">Bodeguero</option>
                <option value="gerente">Gerente</option>
                <option value="administrador">Administrador</option>
              </select>
            </div>
            <div className="flex gap-3 pt-4">
              <button type="button" onClick={() => setShowModal(false)} className="btn-secondary flex-1">
                Cancelar
              </button>
              <button type="submit" className="btn-primary flex-1">
                Crear Usuario
              </button>
            </div>
          </form>
        </Modal>
      </div>
    </Layout>
  )
}

export default Users
