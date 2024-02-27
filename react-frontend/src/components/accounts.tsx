import { useState } from "react";
import { Transaction } from "../types/types";
import { getAccount } from "../network/network";
import moment from "moment";

export default function Accounts() {
  const [accountId, setAccountId] = useState(1);
  const [transactions, setTransactions] = useState<Transaction[]>([]);
  const [errors, setErrors] = useState([]);

  function handleRequest(id: number) {
    getAccount(id)
      .then((response) => {
        setErrors([]);
        setTransactions(response.data.data);
      })
      .catch((error) => {
        setTransactions([]);
        setErrors(error.response.data?.errors);
      })
  }

  return (
    <>
      <section>
        <h4>Display all the transactions of the selected account.</h4>
        <p>Account id:</p>
        <input
          type="text"
          value={accountId}
          onChange={(event) => {
            setAccountId(Number(event.target.value));
            setTransactions([]);
          }}
        />
        <button onClick={() => handleRequest(accountId)}>Search</button>
      </section>
      <section>
        {transactions.map((transaction, index) => {
          return (
            <div key={index}>
              <h5>{transaction.id}. transaction</h5>
              <p>{moment(transaction.created_at).format('LLL')}</p>
              {accountId == transaction.sender_account_id && 
                <h6 className="pico-color-red-450">-{transaction.sender_amount} </h6>
              }
              {accountId == transaction.recipient_account_id &&
                <h6 className="pico-color-green-400">+{transaction.amount}</h6>
              }
            </div>
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
