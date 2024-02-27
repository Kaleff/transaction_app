import { useState } from "react";
import { getClient } from "../network/network";
import { Account } from "../types/types";

export default function Client() {
  const [userId, setUserId] = useState(1);
  const [accounts, setAccounts] = useState<Account[]>([]);
  const [errors, setErrors] = useState([]);

  function handleRequest(id: number) {
    getClient(id)
      .then(function (response) {
        setErrors([]);
        setAccounts(response.data.data);
      })
      .catch((error) => {
        setAccounts([]);
        setErrors(error.response.data?.errors);
      });
  }

  return (
    <>
      <section>
        <h4>Display all the accounts of the selected client.</h4>
        <p>Client id:</p>
        <input
          type="text"
          value={userId}
          onChange={(event) => setUserId(Number(event.target.value))}
        />
        <button onClick={() => handleRequest(userId)}>Search</button>
      </section>
      <section>
        {accounts.map((account, index) => {
          return (
              <h5 key={index}>
                Account number {account.id}:  {account.amount} {account.currency}
              </h5>
          );
        })}
        {errors.map((error, index) => {
          return (
            <h5 key={index} className="pico-color-red-500">
              {error}
            </h5>
          );
        })}
      </section>
    </>
  );
}
