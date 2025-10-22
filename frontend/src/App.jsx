import { Routes, Route, Navigate } from "react-router-dom"
import { AuthProvider } from "./context/AuthContext"
import ProtectedRoute from "./components/ProtectedRoute"
import Login from "./pages/Login"
import AdminDashboard from "./pages/admin/Dashboard"
import AdminUsers from "./pages/admin/Users"
import AdminProviders from "./pages/admin/Providers"
import AdminHistory from "./pages/admin/History"
import GerenteDashboard from "./pages/gerente/Dashboard"
import GerenteMaterials from "./pages/gerente/Materials"
import GerenteOrders from "./pages/gerente/Orders"
import BodegueroMaterials from "./pages/bodeguero/Materials"

function App() {
  return (
    <AuthProvider>
      <Routes>
        <Route path="/login" element={<Login />} />

        {/* Admin Routes */}
        <Route path="/admin" element={<ProtectedRoute allowedRoles={["administrador"]} />}>
          <Route index element={<AdminDashboard />} />
          <Route path="users" element={<AdminUsers />} />
          <Route path="providers" element={<AdminProviders />} />
          <Route path="history" element={<AdminHistory />} />
        </Route>

        {/* Gerente Routes */}
        <Route path="/gerente" element={<ProtectedRoute allowedRoles={["gerente"]} />}>
          <Route index element={<GerenteDashboard />} />
          <Route path="materials" element={<GerenteMaterials />} />
          <Route path="orders" element={<GerenteOrders />} />
        </Route>

        {/* Bodeguero Routes */}
        <Route path="/bodeguero" element={<ProtectedRoute allowedRoles={["bodeguero"]} />}>
          <Route index element={<BodegueroMaterials />} />
        </Route>

        <Route path="/" element={<Navigate to="/login" replace />} />
        <Route path="*" element={<Navigate to="/login" replace />} />
      </Routes>
    </AuthProvider>
  )
}

export default App
