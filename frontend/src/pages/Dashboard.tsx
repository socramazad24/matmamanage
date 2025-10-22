import { useEffect, useState } from 'react';
import { Package, ShoppingCart, Truck, TrendingUp } from 'lucide-react';
import { ApiService } from '@/services/api';

export const Dashboard = () => {
  const [stats, setStats] = useState({
    materials: 0,
    orders: 0,
    providers: 0,
    totalValue: 0,
  });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    loadStats();
  }, []);

  const loadStats = async () => {
    try {
      const [materialsRes, ordersRes, providersRes]: any[] = await Promise.all([
        ApiService.getMaterials(),
        ApiService.getOrders(),
        ApiService.getProviders(),
      ]);

      const materials = materialsRes.data || [];
      const orders = ordersRes.data || [];
      const providers = providersRes.data || [];

      const totalValue = materials.reduce(
        (sum: number, m: any) => sum + (m.costoUnitario * m.cantidadMaterial),
        0
      );

      setStats({
        materials: materials.length,
        orders: orders.length,
        providers: providers.length,
        totalValue,
      });
    } catch (error) {
      console.error('Error al cargar estadísticas:', error);
    } finally {
      setLoading(false);
    }
  };

  const cards = [
    {
      title: 'Materiales',
      value: stats.materials,
      icon: Package,
      color: 'bg-blue-500',
    },
    {
      title: 'Pedidos',
      value: stats.orders,
      icon: ShoppingCart,
      color: 'bg-green-500',
    },
    {
      title: 'Proveedores',
      value: stats.providers,
      icon: Truck,
      color: 'bg-purple-500',
    },
    {
      title: 'Valor Total',
      value: `$${stats.totalValue.toLocaleString()}`,
      icon: TrendingUp,
      color: 'bg-primary-500',
    },
  ];

  if (loading) {
    return (
      <div className="flex items-center justify-center h-64">
        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-400"></div>
      </div>
    );
  }

  return (
    <div className="space-y-6">
      <div>
        <h2 className="text-2xl font-bold text-dark-900 dark:text-white">Dashboard</h2>
        <p className="text-gray-600 dark:text-gray-400 mt-1">
          Resumen general del sistema
        </p>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {cards.map((card) => (
          <div
            key={card.title}
            className="bg-white dark:bg-dark-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow"
          >
            <div className="flex items-center justify-between">
              <div>
                <p className="text-sm text-gray-600 dark:text-gray-400">{card.title}</p>
                <p className="text-2xl font-bold text-dark-900 dark:text-white mt-1">
                  {card.value}
                </p>
              </div>
              <div className={`${card.color} p-3 rounded-lg`}>
                <card.icon className="w-6 h-6 text-white" />
              </div>
            </div>
          </div>
        ))}
      </div>

      <div className="bg-white dark:bg-dark-800 rounded-lg shadow-md p-6">
        <h3 className="text-xl font-semibold text-dark-900 dark:text-white mb-4">
          Bienvenido a MatManager
        </h3>
        <p className="text-gray-600 dark:text-gray-400">
          Sistema de control de materiales de construcción. Utiliza el menú lateral para navegar
          entre las diferentes secciones del sistema.
        </p>
      </div>
    </div>
  );
};
