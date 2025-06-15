import { defineStore } from 'pinia';

export const useStore = defineStore('category', {
  state: () => ({
    categories: [
      { id: 1, label: 'Self-help' },
      { id: 2, label: 'Information Technology' },
      { id: 3, label: 'Financial Economics' },
      { id: 4, label: 'Education' },
      { id: 5, label: 'Lifestyle - Travel' }
    ]
  })
})