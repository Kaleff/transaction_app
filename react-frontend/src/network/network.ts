import axios from "axios";

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