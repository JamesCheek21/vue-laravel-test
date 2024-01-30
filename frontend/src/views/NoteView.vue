<template>
  <main class="w-5/6 md:w-3/4 lg:w-1/2">
    <div v-if="saved" class="bg-green-500 text-white p-4 my-4 rounded-md">
      Note saved successfully!
    </div>
    <div class="py-5 my-6 border-b-2 flex justify-between items-center">
      <RouterLink to="/" class="hover:underline flex items-center gap-2">
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
        Home Page
      </RouterLink>
      <div class="flex items-center gap-2">
        <RouterLink
          :to="'/edit/' + note.id"
          class="flex items-center gap-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
        >
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
              d="m14.3 4.8 2.9 2.9M7 7H4a1 1 0 0 0-1 1v10c0 .6.4 1 1 1h11c.6 0 1-.4 1-1v-4.5m2.4-10a2 2 0 0 1 0 3l-6.8 6.8L8 14l.7-3.6 6.9-6.8a2 2 0 0 1 2.8 0Z"
            />
          </svg>
          Edit
        </RouterLink>
        <button
          type="button"
          class="flex items-center gap-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
          @click.prevent="deleteNote"
        >
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
              d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"
            />
          </svg>
          Delete
        </button>
      </div>
    </div>
    <p class="text-3xl font-bold mb-4">{{ note.title }}</p>
    <p class="text-xl">{{ note.content }}</p>
  </main>
</template>

<script>
import axios from 'axios'
import { RouterLink } from 'vue-router'

export default {
  data() {
    return {
      note: {},
      saved: false
    }
  },
  async created() {
    const noteId = this.$route.params.id
    const { data } = await axios.get(`http://localhost/api/notes/${noteId}`)
    this.note = data

    if (this.$route.query.saved) {
      this.saved = this.$route.query.saved
      setTimeout(() => {
        this.saved = false
      }, 3000)
    }
  },
  methods: {
    async deleteNote() {
      const noteId = this.$route.params.id
      await axios.delete(`http://localhost/api/notes/${noteId}`)

      console.log('HEREEE')

      this.$router.push({ path: `/`, query: { deleted: true } })
    }
  },
  components: { RouterLink }
}
</script>
