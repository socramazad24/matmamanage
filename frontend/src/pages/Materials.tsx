import { useEffect, useState } from 'react';
import { Plus, Edit, Trash2, FileDown } from 'lucide-react';
import { ApiService } from '@/services/api';
import { Material } from '@/types';
import { Button } from '@/components/Button';
import { Modal } from '@/components/Modal';
import { Input } from '@/components/Input';
import { exportToPDF, exportToExcel } from '@/utils/exportUtils';

export const Materials = () => {
  const [materials, setMaterials] = useState<Material[]>([]);
  const [loading, setLoading] = useState(true);
  const [modalOpen, setModalOpen] = useState(false);
  const [editingMaterial, setEditingMaterial] = useState<Material | null>(null);
  const [formData, setFormData] = useState({
    idMaterial: '',
    MaterialName: '',
    Description: '',
    costoUnitario: '',
    cantidadMaterial: '',
    idProveedor: '',
    idPedido: '',
  });

  useEffect(() => {
    loadMaterials();
  }, []);

  const loadMaterials = async () => {
    try {
      const response: any = await ApiService.getMaterials();
      setMaterials(response.data || []);
    } catch (error) {
      console.error('Error al cargar materiales:', error);
    } finally {
      setLoading(false);
    }
  };

  const handleOpenModal = (material?: Material) => {
    if (material) {
      setEditingMaterial(material);
      setFormData({
        idMaterial: material.idMaterial,
        MaterialName: material.MaterialName,
        Description: material.Description,
        costoUnitario: material.costoUnitario.toString(),
        cantidadMaterial: material.cantidadMaterial.toString(),
        idProveedor: material.idProveedor,
        idPedido: material.idPedido,
      });
    } else {
      setEditingMaterial(null);
      setFormData({
        idMaterial: '',
        MaterialName: '',
        Description: '',
        costoUnitario: '',
        cantidadMaterial: '',
        idProveedor: '',
        idPedido: '',
      });
    }
    setModalOpen(true);
  };

  const handleCloseModal = () => {
    setModalOpen(false);
    setEditingMaterial(null);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      if (editingMaterial) {
        await ApiService.updateMaterial(editingMaterial.idMaterial, {
          MaterialName: formData.MaterialName,
          Description: formData.Description,
          costoUnitario: parseInt(formData.costoUnitario),
          cantidadMaterial: parseInt(formData.cantidadMaterial),
          idProveedor: formData.idProveedor,
          idPedido: formData.idPedido,
        });
      } else {
        await ApiService.createMaterial({
          idMaterial: formData.idMaterial,
          MaterialName: formData.MaterialName,
          Description: formData.Description,
          costoUnitario: parseInt(formData.costoUnitario),
          cantidadMaterial: parseInt(formData.cantidadMaterial),
          idProveedor: formData.idProveedor,
          idPedido: formData.idPedido,
          date_reg: new Date().toISOString().split('T')[0],
        });
      }
      handleCloseModal();
      loadMaterials();
    } catch (error) {
      console.error('Error al guardar material:', error);
      alert('Error al guardar el material');
    }
  };

  const handleDelete = async (id: string) => {
    if (!confirm('¿Está seguro de eliminar este material?')) return;

    try {
      await ApiService.deleteMaterial(id);
      loadMaterials();
    } catch (error) {
      console.error('Error al eliminar material:', error);
      alert('Error al eliminar el material');
    }
  };

  const handleExportPDF = () => {
    const columns = [
      { header: 'ID', key: 'idMaterial' },
      { header: 'Nombre', key: 'MaterialName' },
      { header: 'Descripción', key: 'Description' },
      { header: 'Costo', key: 'costoUnitario' },
      { header: 'Cantidad', key: 'cantidadMaterial' },
      { header: 'Proveedor', key: 'idProveedor' },
    ];
    exportToPDF(materials, columns, 'Materiales');
  };

  const handleExportExcel = () => {
    exportToExcel(materials, 'materiales');
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
          <h2 className="text-2xl font-bold text-dark-900 dark:text-white">Materiales</h2>
          <p className="text-gray-600 dark:text-gray-400 mt-1">
            Gestión de materiales de construcción
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
          <Button onClick={() => handleOpenModal()}>
            <Plus className="w-4 h-4 mr-2" />
            Nuevo Material
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
                  Descripción
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Costo Unitario
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Cantidad
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Proveedor
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Acciones
                </th>
              </tr>
            </thead>
            <tbody className="divide-y divide-gray-200 dark:divide-dark-700">
              {materials.map((material) => (
                <tr key={material.idMaterial} className="hover:bg-gray-50 dark:hover:bg-dark-700">
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-dark-900 dark:text-white">
                    {material.idMaterial}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-dark-900 dark:text-white">
                    {material.MaterialName}
                  </td>
                  <td className="px-6 py-4 text-sm text-dark-900 dark:text-white">
                    {material.Description}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-dark-900 dark:text-white">
                    ${material.costoUnitario.toLocaleString()}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-dark-900 dark:text-white">
                    {material.cantidadMaterial}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-dark-900 dark:text-white">
                    {material.idProveedor}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm">
                    <div className="flex gap-2">
                      <button
                        onClick={() => handleOpenModal(material)}
                        className="text-primary-600 hover:text-primary-700"
                      >
                        <Edit className="w-4 h-4" />
                      </button>
                      <button
                        onClick={() => handleDelete(material.idMaterial)}
                        className="text-red-600 hover:text-red-700"
                      >
                        <Trash2 className="w-4 h-4" />
                      </button>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>

      <Modal
        isOpen={modalOpen}
        onClose={handleCloseModal}
        title={editingMaterial ? 'Editar Material' : 'Nuevo Material'}
      >
        <form onSubmit={handleSubmit} className="space-y-4">
          {!editingMaterial && (
            <Input
              label="ID Material"
              value={formData.idMaterial}
              onChange={(e) => setFormData({ ...formData, idMaterial: e.target.value })}
              required
            />
          )}
          <Input
            label="Nombre"
            value={formData.MaterialName}
            onChange={(e) => setFormData({ ...formData, MaterialName: e.target.value })}
            required
          />
          <Input
            label="Descripción"
            value={formData.Description}
            onChange={(e) => setFormData({ ...formData, Description: e.target.value })}
            required
          />
          <Input
            label="Costo Unitario"
            type="number"
            value={formData.costoUnitario}
            onChange={(e) => setFormData({ ...formData, costoUnitario: e.target.value })}
            required
          />
          <Input
            label="Cantidad"
            type="number"
            value={formData.cantidadMaterial}
            onChange={(e) => setFormData({ ...formData, cantidadMaterial: e.target.value })}
            required
          />
          <Input
            label="ID Proveedor"
            value={formData.idProveedor}
            onChange={(e) => setFormData({ ...formData, idProveedor: e.target.value })}
            required
          />
          <Input
            label="ID Pedido"
            value={formData.idPedido}
            onChange={(e) => setFormData({ ...formData, idPedido: e.target.value })}
          />
          <div className="flex justify-end gap-2 pt-4">
            <Button type="button" variant="secondary" onClick={handleCloseModal}>
              Cancelar
            </Button>
            <Button type="submit">
              {editingMaterial ? 'Actualizar' : 'Crear'}
            </Button>
          </div>
        </form>
      </Modal>
    </div>
  );
};
