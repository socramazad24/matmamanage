import { useEffect, useState } from 'react';
import { Plus, FileDown } from 'lucide-react';
import { ApiService } from '@/services/api';
import { Order } from '@/types';
import { Button } from '@/components/Button';
import { Modal } from '@/components/Modal';
import { Input } from '@/components/Input';
import { exportToPDF, exportToExcel } from '@/utils/exportUtils';

export const Orders = () => {
  const [orders, setOrders] = useState<Order[]>([]);
  const [loading, setLoading] = useState(true);
  const [modalOpen, setModalOpen] = useState(false);
  const [formData, setFormData] = useState({
    idPedido: '',
    idProveedor: '',
    MaterialName: '',
    Description: '',
    cantidadMaterial: '',
    costoUnitario: '',
    Estado: 'Pendiente',
  });

  useEffect(() => {
    loadOrders();
  }, []);

  const loadOrders = async () => {
    try {
      const response: any = await ApiService.getOrders();
      setOrders(response.data || []);
    } catch (error) {
      console.error('Error al cargar pedidos:', error);
    } finally {
      setLoading(false);
    }
  };

  const handleOpenModal = () => {
    setFormData({
      idPedido: '',
      idProveedor: '',
      MaterialName: '',
      Description: '',
      cantidadMaterial: '',
      costoUnitario: '',
      Estado: 'Pendiente',
    });
    setModalOpen(true);
  };

  const handleCloseModal = () => {
    setModalOpen(false);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      await ApiService.createOrder({
        idPedido: formData.idPedido,
        idProveedor: formData.idProveedor,
        MaterialName: formData.MaterialName,
        Description: formData.Description,
        cantidadMaterial: parseInt(formData.cantidadMaterial),
        costoUnitario: parseInt(formData.costoUnitario),
        Estado: formData.Estado,
        fecha_reg: new Date().toISOString().split('T')[0],
      });
      handleCloseModal();
      loadOrders();
    } catch (error) {
      console.error('Error al crear pedido:', error);
      alert('Error al crear el pedido');
    }
  };

  const handleExportPDF = () => {
    const columns = [
      { header: 'ID', key: 'idPedido' },
      { header: 'Proveedor', key: 'idProveedor' },
      { header: 'Material', key: 'MaterialName' },
      { header: 'Cantidad', key: 'cantidadMaterial' },
      { header: 'Costo', key: 'costoUnitario' },
      { header: 'Estado', key: 'Estado' },
      { header: 'Fecha', key: 'fecha_reg' },
    ];
    exportToPDF(orders, columns, 'Pedidos');
  };

  const handleExportExcel = () => {
    exportToExcel(orders, 'pedidos');
  };

  if (loading) {
    return (
      <div className="flex items-center justify-center h-64">
        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-400"></div>
      </div>
    );
  }

  return (
    <div className="space-y-6">
      <div className="flex justify-between items-center">
        <div>
          <h2 className="text-2xl font-bold text-dark-900 dark:text-white">Pedidos</h2>
          <p className="text-gray-600 dark:text-gray-400 mt-1">
            Gestión de pedidos de materiales
          </p>
        </div>
        <div className="flex gap-2">
          <Button variant="secondary" onClick={handleExportPDF}>
            <FileDown className="w-4 h-4 mr-2" />
            PDF
          </Button>
          <Button variant="secondary" onClick={handleExportExcel}>
            <FileDown className="w-4 h-4 mr-2" />
            Excel
          </Button>
          <Button onClick={handleOpenModal}>
            <Plus className="w-4 h-4 mr-2" />
            Nuevo Pedido
          </Button>
        </div>
      </div>

      <div className="bg-white dark:bg-dark-800 rounded-lg shadow-md overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead className="bg-gray-50 dark:bg-dark-700">
              <tr>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  ID
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Proveedor
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Material
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Descripción
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Cantidad
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Costo
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Estado
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Fecha
                </th>
              </tr>
            </thead>
            <tbody className="divide-y divide-gray-200 dark:divide-dark-700">
              {orders.map((order) => (
                <tr key={order.idPedido} className="hover:bg-gray-50 dark:hover:bg-dark-700">
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-dark-900 dark:text-white">
                    {order.idPedido}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-dark-900 dark:text-white">
                    {order.idProveedor}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-dark-900 dark:text-white">
                    {order.MaterialName}
                  </td>
                  <td className="px-6 py-4 text-sm text-dark-900 dark:text-white">
                    {order.Description}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-dark-900 dark:text-white">
                    {order.cantidadMaterial}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-dark-900 dark:text-white">
                    ${order.costoUnitario.toLocaleString()}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <span
                      className={`px-2 py-1 text-xs rounded-full ${
                        order.Estado === 'Recibido'
                          ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400'
                          : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400'
                      }`}
                    >
                      {order.Estado || 'Pendiente'}
                    </span>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-dark-900 dark:text-white">
                    {order.fecha_reg}
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>

      <Modal isOpen={modalOpen} onClose={handleCloseModal} title="Nuevo Pedido">
        <form onSubmit={handleSubmit} className="space-y-4">
          <Input
            label="ID Pedido"
            value={formData.idPedido}
            onChange={(e) => setFormData({ ...formData, idPedido: e.target.value })}
            required
          />
          <Input
            label="ID Proveedor"
            value={formData.idProveedor}
            onChange={(e) => setFormData({ ...formData, idProveedor: e.target.value })}
            required
          />
          <Input
            label="Material"
            value={formData.MaterialName}
            onChange={(e) => setFormData({ ...formData, MaterialName: e.target.value })}
            required
          />
          <Input
            label="Descripción"
            value={formData.Description}
            onChange={(e) => setFormData({ ...formData, Description: e.target.value })}
          />
          <Input
            label="Cantidad"
            type="number"
            value={formData.cantidadMaterial}
            onChange={(e) => setFormData({ ...formData, cantidadMaterial: e.target.value })}
            required
          />
          <Input
            label="Costo Unitario"
            type="number"
            value={formData.costoUnitario}
            onChange={(e) => setFormData({ ...formData, costoUnitario: e.target.value })}
            required
          />
          <div className="flex justify-end gap-2 pt-4">
            <Button type="button" variant="secondary" onClick={handleCloseModal}>
              Cancelar
            </Button>
            <Button type="submit">Crear</Button>
          </div>
        </form>
      </Modal>
    </div>
  );
};
