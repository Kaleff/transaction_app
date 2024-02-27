import React from 'react'
import ReactDOM from 'react-dom/client'
import {
  createBrowserRouter,
  RouterProvider,
} from "react-router-dom";
import App from './App.tsx'
import './index.css'
import ErrorPage from './components/error-page.tsx';
import Rates from './components/rates.tsx';
import Accounts from './components/accounts.tsx';
import Client from './components/client.tsx';
import Transaction from './components/transaction.tsx';
import '@picocss/pico';

const router = createBrowserRouter([
  {
    path: "/",
    element: <App />,
    errorElement: <ErrorPage />,
    children: [
      {
        path: "rates",
        element: <Rates />,
      },
      {
        path: "accounts",
        element: <Accounts />,
      },
      {
        path: "client",
        element: <Client />,
      },
      {
        path: "transaction",
        element: <Transaction />,
      },
    ], 
  },
]);

ReactDOM.createRoot(document.getElementById('root')!).render(
  <React.StrictMode>
    <RouterProvider router={router} />
  </React.StrictMode>,
)
