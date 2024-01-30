<template>
  <main class="w-5/6 md:w-3/4 lg:w-1/2">
    <div class="py-5 my-6 border-b-2 flex justify-between items-center">
      <RouterLink :to="'/view/' + note.id" class="hover:underline flex items-center gap-2">
        <svg
          class="w-6 h-6 text-gray-800 dark:text-white"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1.4"
            d="M5 12h14M5 12l4-4m-4 4 4 4"
          />
        </svg>
        Back
      </RouterLink>
    </div>
    <form @submit.prevent="saveNote" class="mt-4">
      <div class="mb-4">
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Title</label
        >
        <input
          v-model="note.title"
          type="text"
          id="title"
          name="title"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        />
        <div v-if="errors && errors.title" class="text-red-500 text-sm mt-1">
          {{ errors.title }}
        </div>
      </div>

      <div class="mb-4">
        <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Content</label
        >
        <textarea
          v-model="note.content"
          id="content"
          name="content"
          rows="4"
          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        ></textarea>
        <div v-if="errors && errors.content" class="text-red-500 text-sm mt-1">
          {{ errors.content }}
        </div>
      </div>

      <div class="flex items-center gap-2 justify-end mt-4">
        <button
          type="submit"
          class="flex items-center gap-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
        >
          Save
        </button>
        <RouterLink
          :to="'/view/' + note.id"
          class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
        >
          Cancel
        </RouterLink>
      </div>
    </form>
  </main>
</template>

<script>
import axios from 'axios'
import { RouterLink } from 'vue-router'

export default {
  data() {
    return {
      note: {},
      errors: null
    }
  },
  async created() {
    const noteId = this.$route.params.id
    const { data } = await axios.get(`http://localhost/api/notes/${noteId}`)
    this.note = data
  },
  methods: {
    async saveNote() {
      try {
        await axios.put(`http://localhost/api/notes/${this.note.id}`, this.note)

        this.$router.push({ path: `/view/${this.note.id}`, query: { saved: true } })
      } catch (error) {
        this.errors = {}

        if (error.response.data && error.response.data.errors) {
          Object.keys(error.response.data.errors).forEach((field) => {
            this.errors[field] = error.response.data.errors[field][0]
          })
        }
      }
    }
  },
  components: { RouterLink }
}
</script>
