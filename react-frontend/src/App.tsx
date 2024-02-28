import { Link, Outlet } from 'react-router-dom'
import './App.css'

function App() {
  return (
    <>
    <header>
      <ul className='flex_center'>
        <li><Link to={'client'}>Clients</Link></li>
        <li><Link to={'accounts'}>Accounts</Link></li>
        <li><Link to={'rates'}>Rates</Link></li>
        <li><Link to={'transaction'}>Transaction</Link></li>
      </ul>
    </header>
      <Outlet />
    </>
  )
}

export default App
