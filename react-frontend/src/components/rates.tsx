import { useEffect, useState } from "react";
import { FreshRates, Rate } from "../types/types";
import { getFreshRates, getRates, uploadRates } from "../network/network";
import moment from "moment";

export default function Rates() {
  const [rates, setRates] = useState<Rate[]>([]);
  const [success, setSuccess] = useState('');
  const [errors, setErrors] = useState([]);

  useEffect(() => {
    getRates()
      .then((response) => {
        setErrors([]);
        setRates(response.data.data);
      })
      .catch((error) => {
        setRates([]);
        setErrors(error.response.data?.errors);
        setSuccess('');
      });
  }, []);

  function storeRates(rates: FreshRates) {
    uploadRates(rates)
      .then((response) => {
        console.log(response.data.data);
        setSuccess('Update was perfomed successfully');
        setRates(response.data.data);
      })
      .catch((error) => {
        setErrors(error.response.data?.errors);
        setSuccess('');
      });
  }

  function updateRates() {
    getFreshRates()
      .then((response) => {
        console.log(response.data);
        storeRates(response.data);
      })
  }

  return (
    <section>
      <h4>Display all the available current rates</h4>
      {rates && (
        <table>
          <tr>
            <th>Currency</th>
            <th>Rate</th>
            <th>Updated at</th>
          </tr>
          {rates.map((rate, index) => {
            return (
              <tr key={index}>
                <td>
                  {rate.name} ({rate.currency})
                </td>
                <td>{rate.exchange_rate}</td>
                <td>{moment(rate.updated_at).format("LLL")}</td>
              </tr>
            );
          })}
        </table>
      )}
      <button onClick={() => updateRates()}>Update rates</button>
      {success && <h5 className="pico-color-green-400">{success}</h5>}
      {errors.map((error, index) => {
          return (
            <h5 key={index} className="pico-color-red-500">
              {error}
            </h5>
          );
        })}
    </section>
  );
}
