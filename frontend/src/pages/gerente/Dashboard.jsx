import Layout from "../../components/Layout"
import DashboardCard from "../../components/DashboardCard"

const GerenteDashboard = () => {
  return (
    <Layout title="MAT-MANAGER - Gerente">
      <section className="container mx-auto px-5 py-16">
        <div className="flex flex-wrap -m-4 justify-center">
          <DashboardCard
            title="Materiales"
            description="Ver y gestionar el inventario de materiales"
            link="/gerente/materials"
          />
          <DashboardCard title="Pedidos" description="Gestionar pedidos y órdenes de compra" link="/gerente/orders" />
        </div>
      </section>
    </Layout>
  )
}

export default GerenteDashboard
