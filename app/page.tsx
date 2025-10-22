export default function Page() {
  return (
    <div className="min-h-screen bg-gray-50 flex items-center justify-center p-8">
      <div className="max-w-4xl w-full bg-white rounded-2xl shadow-xl p-8 md:p-12">
        <div className="text-center mb-8">
          <h1 className="text-4xl font-bold text-gray-900 mb-4">MAT-MANAGER</h1>
          <p className="text-xl text-gray-600">React + Vite Application</p>
        </div>

        <div className="bg-yellow-50 border-l-4 border-yellow-400 p-6 mb-8">
          <div className="flex">
            <div className="flex-shrink-0">
              <svg className="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                <path
                  fillRule="evenodd"
                  d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                  clipRule="evenodd"
                />
              </svg>
            </div>
            <div className="ml-3">
              <h3 className="text-sm font-medium text-yellow-800">Esta es una aplicación React + Vite independiente</h3>
              <div className="mt-2 text-sm text-yellow-700">
                <p>
                  El frontend se encuentra en la carpeta{" "}
                  <code className="bg-yellow-100 px-2 py-1 rounded">/frontend</code> y debe ejecutarse por separado.
                </p>
              </div>
            </div>
          </div>
        </div>

        <div className="space-y-6">
          <div>
            <h2 className="text-2xl font-bold text-gray-900 mb-4">🚀 Cómo ejecutar el proyecto</h2>

            <div className="space-y-4">
              <div className="bg-gray-50 rounded-lg p-4">
                <h3 className="font-semibold text-gray-900 mb-2">1. Instalar dependencias</h3>
                <pre className="bg-gray-900 text-green-400 p-3 rounded overflow-x-auto">
                  <code>cd frontend{"\n"}npm install</code>
                </pre>
              </div>

              <div className="bg-gray-50 rounded-lg p-4">
                <h3 className="font-semibold text-gray-900 mb-2">2. Iniciar el servidor de desarrollo</h3>
                <pre className="bg-gray-900 text-green-400 p-3 rounded overflow-x-auto">
                  <code>npm run dev</code>
                </pre>
              </div>

              <div className="bg-gray-50 rounded-lg p-4">
                <h3 className="font-semibold text-gray-900 mb-2">3. Abrir en el navegador</h3>
                <p className="text-gray-700">La aplicación estará disponible en:</p>
                <pre className="bg-gray-900 text-blue-400 p-3 rounded mt-2">
                  <code>http://localhost:3000</code>
                </pre>
              </div>
            </div>
          </div>

          <div className="border-t pt-6">
            <h2 className="text-2xl font-bold text-gray-900 mb-4">📁 Estructura del Proyecto</h2>
            <div className="bg-gray-50 rounded-lg p-4">
              <pre className="text-sm text-gray-700 overflow-x-auto">
                {`frontend/
├── src/
│   ├── components/      # Componentes reutilizables
│   ├── context/         # Context API (Auth)
│   ├── pages/          # Páginas de la app
│   │   ├── Login.jsx
│   │   ├── admin/      # Dashboard admin
│   │   ├── gerente/    # Dashboard gerente
│   │   └── bodeguero/  # Dashboard bodeguero
│   ├── services/       # API service
│   └── App.jsx         # Componente principal
├── public/images/      # Imágenes del proyecto
└── package.json`}
              </pre>
            </div>
          </div>

          <div className="border-t pt-6">
            <h2 className="text-2xl font-bold text-gray-900 mb-4">🎨 Características</h2>
            <ul className="grid grid-cols-1 md:grid-cols-2 gap-3">
              <li className="flex items-start">
                <span className="text-yellow-500 mr-2">✓</span>
                <span className="text-gray-700">React 18 + Vite</span>
              </li>
              <li className="flex items-start">
                <span className="text-yellow-500 mr-2">✓</span>
                <span className="text-gray-700">TailwindCSS</span>
              </li>
              <li className="flex items-start">
                <span className="text-yellow-500 mr-2">✓</span>
                <span className="text-gray-700">React Router DOM</span>
              </li>
              <li className="flex items-start">
                <span className="text-yellow-500 mr-2">✓</span>
                <span className="text-gray-700">Context API para Auth</span>
              </li>
              <li className="flex items-start">
                <span className="text-yellow-500 mr-2">✓</span>
                <span className="text-gray-700">Diseño Minimalista</span>
              </li>
              <li className="flex items-start">
                <span className="text-yellow-500 mr-2">✓</span>
                <span className="text-gray-700">Responsive Design</span>
              </li>
            </ul>
          </div>

          <div className="border-t pt-6">
            <h2 className="text-2xl font-bold text-gray-900 mb-4">📖 Documentación</h2>
            <p className="text-gray-700 mb-3">
              Para más información sobre la estructura, configuración y uso del proyecto, consulta el archivo:
            </p>
            <div className="bg-gray-900 text-blue-400 p-3 rounded inline-block">
              <code>README.md</code>
            </div>
          </div>
        </div>

        <div className="mt-8 pt-6 border-t text-center text-gray-500 text-sm">
          <p>Desarrollado con ❤️ usando React + Vite + TailwindCSS</p>
        </div>
      </div>
    </div>
  )
}
