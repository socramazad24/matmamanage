import { useEffect, useState } from 'react';
import { Plus, FileDown } from 'lucide-react';
import { ApiService } from '@/services/api';
import { Provider } from '@/types';
import { Button } from '@/components/Button';
import { Modal } from '@/components/Modal';
import { Input } from '@/components/Input';
import { exportToPDF, exportToExcel } from '@/utils/exportUtils';

export const Providers = () => {
  const [providers, setProviders] = useState<Provider[]>([]);
  const [loading, setLoading] = useState(true);
  const [modalOpen, setModalOpen] = useState(false);
  const [formData, setFormData] = useState({
    idProveedor: '',
    nameProveedor: '',
    materiales: '',
    telefono: '',
    correo: '',
    direccion: '',
  });

  useEffect(() => {
    loadProviders();
  }, []);

  const loadProviders = async () => {
    try {
      const response: any = await ApiService.getProviders();
      setProviders(response.data || []);
    } catch (error) {
      console.error('Error al cargar proveedores:', error);
    } finally {
      setLoading(false);
    }
  };

  const handleOpenModal = () => {
    setFormData({
      idProveedor: '',
      nameProveedor: '',
      materiales: '',
      telefono: '',
      correo: '',
      direccion: '',
    });
    setModalOpen(true);
  };

  const handleCloseModal = () => {
    setModalOpen(false);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      await ApiService.createProvider({
        idProveedor: formData.idProveedor,
        nameProveedor: formData.nameProveedor,
        materiales: formData.materiales,
        telefono: parseInt(formData.telefono),
        correo: formData.correo,
        direccion: formData.direccion,
        date_reg: new Date().toISOString().split('T')[0],
      });
      handleCloseModal();
      loadProviders();
    } catch (error) {
      console.error('Error al crear proveedor:', error);
      alert('Error al crear el proveedor');
    }
  };

  const handleExportPDF = () => {
    const columns = [
      { header: 'ID', key: 'idProveedor' },
      { header: 'Nombre', key: 'nameProveedor' },
      { header: 'Materiales', key: 'materiales' },
      { header: 'Teléfono', key: 'telefono' },
      { header: 'Correo', key: 'correo' },
      { header: 'Dirección', key: 'direccion' },
    ];
    exportToPDF(providers, columns, 'Proveedores');
  };

  const handleExportExcel = () => {
    exportToExcel(providers, 'proveedores');
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
          <h2 className="text-2xl font-bold text-dark-900 dark:text-white">Proveedores</h2>
          <p className="text-gray-600 dark:text-gray-400 mt-1">
            Gestión de proveedores de materiales
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
            Nuevo Proveedor
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
                  Nombre
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Materiales
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Teléfono
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Correo
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Dirección
                </th>
              </tr>
            </thead>
            <tbody className="divide-y divide-gray-200 dark:divide-dark-700">
              {providers.map((provider) => (
                <tr key={provider.idProveedor} className="hover:bg-gray-50 dark:hover:bg-dark-700">
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-dark-900 dark:text-white">
                    {provider.idProveedor}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-dark-900 dark:text-white">
                    {provider.nameProveedor}
                  </td>
                  <td className="px-6 py-4 text-sm text-dark-900 dark:text-white">
                    {provider.materiales}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-dark-900 dark:text-white">
                    {provider.telefono}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-dark-900 dark:text-white">
                    {provider.correo}
                  </td>
                  <td className="px-6 py-4 text-sm text-dark-900 dark:text-white">
                    {provider.direccion}
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>

      <Modal isOpen={modalOpen} onClose={handleCloseModal} title="Nuevo Proveedor">
        <form onSubmit={handleSubmit} className="space-y-4">
          <Input
            label="ID Proveedor"
            value={formData.idProveedor}
            onChange={(e) => setFormData({ ...formData, idProveedor: e.target.value })}
            required
          />
          <Input
            label="Nombre"
            value={formData.nameProveedor}
            onChange={(e) => setFormData({ ...formData, nameProveedor: e.target.value })}
            required
          />
          <Input
            label="Materiales"
            value={formData.materiales}
            onChange={(e) => setFormData({ ...formData, materiales: e.target.value })}
            required
          />
          <Input
            label="Teléfono"
            type="tel"
            value={formData.telefono}
            onChange={(e) => setFormData({ ...formData, telefono: e.target.value })}
            required
          />
          <Input
            label="Correo"
            type="email"
            value={formData.correo}
            onChange={(e) => setFormData({ ...formData, correo: e.target.value })}
            required
          />
          <Input
            label="Dirección"
            value={formData.direccion}
            onChange={(e) => setFormData({ ...formData, direccion: e.target.value })}
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
