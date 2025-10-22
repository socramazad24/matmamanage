import { Link } from "react-router-dom"

const DashboardCard = ({ title, description, image, link, category = "CATEGORY-1" }) => {
  return (
    <div className="p-4 md:w-1/3">
      <div className="card h-full bg-gradient-to-r from-amber-50 to-yellow-50">
        {image && (
          <img
            src={image || "/placeholder.svg"}
            alt={title}
            className="w-full h-48 object-cover object-center transition-transform duration-300 hover:scale-105"
          />
        )}
        <div className="p-6">
          <h2 className="tracking-widest text-xs font-medium text-gray-600 mb-1">{category}</h2>
          <h3 className="text-lg font-bold text-gray-900 mb-3">{title}</h3>
          <p className="leading-relaxed mb-4 text-gray-600 text-sm">{description}</p>
          <Link to={link}>
            <button className="btn-secondary">Ver {title}</button>
          </Link>
        </div>
      </div>
    </div>
  )
}

export default DashboardCard
