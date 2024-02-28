export type RouterError = {
  statusText: string;
  message: string;
}

export type Account = {
  id: number;
  currency: string;
  amount: number;
}

export type Transaction = {
  id: number;
  currency: string;
  amount: number;
  sender_amount: number;
  sender_account_id: number;
  recipient_account_id: number;
  sender_currency: string;
  created_at: string
}

export type Rate = {
  id: number;
  created_at: string;
  updated_at: string;
  currency: string;
  name: string;
  exchange_rate: number;
}

export type FreshRates = {
  base: string;
  date: string;
  rates: object;
  success: boolean;
  timestamp: number;
}

export type NewTransaction = {
  sender_account_id: number,
  recipient_account_id: number;
  currency: string;
  amount: number;
}

export type NewBalance = {
  recipient_balance: number,
  sender_balance: number
}