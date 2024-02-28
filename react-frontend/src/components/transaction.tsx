import { useState } from "react";
import { Account, NewBalance } from "../types/types";
import { getSenderRecipient, storeTransaction } from "../network/network";

export default function Transaction() {
  const [senderAccId, setSenderAccId] = useState(1);
  const [recipientAccId, setRecipientAccId] = useState(1);
  const [sender, setSender] = useState<Account>();
  const [recipient, setRecipient] = useState<Account>();
  const [accErrors, setAccErrors] = useState([]);
  const [amount, setAmount] = useState(0);
  const [success, setSuccess] = useState('');
  const [transError, setTransError] = useState([]);
  const [newBalance, setNewBalance] = useState<NewBalance>();

  function getAccounts() {
    setTransError([]);
    setSuccess('');
    setNewBalance(undefined);
    setAmount(0);
    getSenderRecipient(senderAccId, recipientAccId)
      .then((response) => {
        setAccErrors([]);
        setSender(response.data.data.sender);
        setRecipient(response.data.data.recipient);
      })
      .catch((error) => {
        setSender(undefined);
        setRecipient(undefined);
        setAccErrors(error.response.data?.errors);
      });
  }

  function sendTransaction() {
    storeTransaction({
      sender_account_id: sender ? sender?.id : 0,
      recipient_account_id: recipient ? recipient.id : 0,
      currency: recipient ? recipient.currency : 'EUR',
      amount: amount,
    })
      .then((response) => {
        setSuccess(response.data.message);
        setNewBalance({
          sender_balance: response.data.sender_balance,
          recipient_balance: response.data.recipient_balance
        });
        setTransError([]);
      })
      .catch((error) => {
        setSuccess('');
        setTransError(error.response.data?.errors);
      })
  }

  return (
    <>
      <section>
        <h4>Do a transaction</h4>
        <div className="transaction_box">
          <div className="">
            <p>Sender account id:</p>
            <input
              type="text"
              value={senderAccId}
              onChange={(event) => setSenderAccId(Number(event.target.value))}
            />
            {sender && (
              <h5 className="no_top">
                {newBalance ? newBalance.sender_balance : sender.amount} {sender.currency}
              </h5>
            )}
          </div>
          <div>
            <p>Recipient account id:</p>
            <input
              type="text"
              value={recipientAccId}
              onChange={(event) =>
                setRecipientAccId(Number(event.target.value))
              }
            />
            {recipient && (
              <h5 className="no_top">
                {newBalance ? newBalance.recipient_balance : recipient.amount} {recipient.currency}
              </h5>
            )}
          </div>
        </div>
        <button onClick={() => getAccounts()}>Get account information</button>
      </section>
      <section>
        {accErrors.map((error, index) => {
          return (
            <h5 key={index} className="pico-color-red-500">
              {error}
            </h5>
          );
        })}
      </section>
      {sender && recipient && 
        <section>
          <h4>Trasnfer money:</h4>
          <input
            type="text"
            value={amount}
            onChange={(event) =>
              setAmount(Number(event.target.value))
            }
          />
          <button onClick={() => sendTransaction()}>Send</button>
        </section>
      }
      <section>
        {transError.map((error, index) => {
          return (
            <h5 key={index} className="pico-color-red-500">
              {error}
            </h5>
          );
        })}
        {success && <h5 className="pico-color-green-400">{success}</h5>}
      </section>
    </>
  );
}
