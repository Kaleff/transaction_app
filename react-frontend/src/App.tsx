import { Link, Outlet } from 'react-router-dom'
import './App.css'

function App() {
  return (
    <>
    <header>
    <nav>
      <ul>
        <li><Link to={'client'}>Clients</Link></li>
        <li><Link to={'accounts'}>Accounts</Link></li>
        <li><Link to={'rates'}>Rates</Link></li>
        <li><Link to={'transaction'}>Transaction</Link></li>
      </ul>
    </nav>
    </header>
      <Outlet />
    </>
  )
}

export default App
