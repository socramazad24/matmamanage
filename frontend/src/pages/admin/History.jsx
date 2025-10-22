import Layout from "../../components/Layout"

const History = () => {
  return (
    <Layout title="MAT-MANAGER - Historial">
      <div className="container mx-auto px-5 py-8">
        <h2 className="text-3xl font-bold text-gray-900 mb-6">Historial de Registros</h2>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div className="card p-6">
            <h3 className="text-xl font-bold text-secondary mb-4">Historial de Usuarios</h3>
            <p className="text-gray-600 mb-4">Registro de todas las operaciones realizadas sobre usuarios</p>
            <button className="btn-secondary">Ver Historial</button>
          </div>

          <div className="card p-6">
            <h3 className="text-xl font-bold text-secondary mb-4">Historial de Materiales</h3>
            <p className="text-gray-600 mb-4">Registro de todas las operaciones realizadas sobre materiales</p>
            <button className="btn-secondary">Ver Historial</button>
          </div>

          <div className="card p-6">
            <h3 className="text-xl font-bold text-secondary mb-4">Historial de Pedidos</h3>
            <p className="text-gray-600 mb-4">Registro de todas las operaciones realizadas sobre pedidos</p>
            <button className="btn-secondary">Ver Historial</button>
          </div>

          <div className="card p-6">
            <h3 className="text-xl font-bold text-secondary mb-4">Historial de Proveedores</h3>
            <p className="text-gray-600 mb-4">Registro de todas las operaciones realizadas sobre proveedores</p>
            <button className="btn-secondary">Ver Historial</button>
          </div>
        </div>
      </div>
    </Layout>
  )
}

export default History
