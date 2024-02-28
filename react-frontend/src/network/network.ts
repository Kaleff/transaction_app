import axios from "axios";
import { FreshRates, NewTransaction } from "../types/types";

export function getClient(id: number) {
  return axios({
    method: 'get',
    url: `http://localhost/api/client/${id}`,
  })
}

export function getAccount(id: number) {
  return axios({
    method: 'get',
    url: `http://localhost/api/accounts/${id}`
  })
}

export function getRates() {
  return axios({
    method: 'get',
    url: 'http://localhost/api/rates/'
  })
}

export function getFreshRates() {
  return axios({
    method: 'get',
    headers: {
      apikey: "sFPGZuddQknkkLST8Cq2qbV7ydxMVTSb"
    },
    url: 'https://api.apilayer.com/fixer/latest?symbols=GBP%2C%20USD%2C%20CHF%2C%20HUF%2C%20CZK%2C%20SEK%2C%20DKK%2C%20NOK%2C%20RON%2C%20PLN%2C%20TRY%2C%20BGN%2C%20MXN%2C%20CAD%2C%20AUD%2C%20CNY%2C%20JPY&base=EUR'
  })
}

export function uploadRates(rates: FreshRates) {
  return axios({
    method: 'post',
    url: 'http://localhost/api/rates',
    data: rates
  })
}

export function getSenderRecipient(senderAccountId: number, recipientAccountId: number) {
  return axios({
    method: 'get',
    url: `http://localhost/api/accounts/${senderAccountId}/${recipientAccountId}`
  })
}

export function storeTransaction(transaction: NewTransaction) {
  return axios({
    method: 'post',
    url: 'http://localhost/api/transaction',
    data: transaction
  })
}