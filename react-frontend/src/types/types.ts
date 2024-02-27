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

export type RouterError = {
  statusText: string;
  message: string;
}