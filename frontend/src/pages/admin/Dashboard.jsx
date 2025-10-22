import Layout from "../../components/Layout"
import DashboardCard from "../../components/DashboardCard"

const AdminDashboard = () => {
  return (
    <Layout title="MAT-MANAGER - Administrador">
      <section className="container mx-auto px-5 py-16">
        <div className="flex flex-wrap -m-4 justify-center">
          <DashboardCard
            title="Usuarios"
            description="Listado de usuarios registrados y/o por registrar, con su respectiva información prevalente en el sistema"
            image="/images/listaUsuarios.png"
            link="/admin/users"
          />
          <DashboardCard
            title="Proveedores"
            description="Listado de proveedores registrados y/o por registrar, con información prevalente e información de materiales"
            image="/images/listaProveedores.png"
            link="/admin/providers"
          />
          <DashboardCard
            title="Registros"
            description="Listado de los Historiales de usuarios, materiales, pedidos y proveedores, con información de creación y edición"
            image="/images/historial.png"
            link="/admin/history"
          />
        </div>
      </section>
    </Layout>
  )
}

export default AdminDashboard
