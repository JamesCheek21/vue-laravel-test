<template>
  <main class="w-5/6 md:w-3/4 lg:w-1/2">
    <div v-if="saved" class="bg-green-500 text-white p-4 my-4 rounded-md">
      Note saved successfully!
    </div>
    <div v-if="deleted" class="bg-red-500 text-white p-4 my-4 rounded-md">
      Note deleted successfully!
    </div>
    <div class="py-5 my-6 border-b-2 flex justify-between items-center">
      <p class="text-4xl font-bold">Notes App</p>
      <RouterLink
        to="/create"
        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
      >
        Create Note
      </RouterLink>
    </div>
    <div class="py-2">
      <div
        v-for="note in notes"
        :key="note.id"
        class="w-full my-4 p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900"
      >
        <RouterLink :to="'/view/' + note.id">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            {{ note.title }}
          </h5>
          <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
            {{ note.content }}
          </p>
        </RouterLink>
      </div>
    </div>
  </main>
</template>

<script>
import axios from 'axios'

export default {
  name: 'App',
  data() {
    return {
      notes: {},
      saved: false,
      deleted: false
    }
  },
  async created() {
    if (this.$route.query.saved) {
      this.saved = this.$route.query.saved
      setTimeout(() => {
        this.saved = false
      }, 3000)
    }

    if (this.$route.query.deleted) {
      this.deleted = this.$route.query.deleted
      setTimeout(() => {
        this.deleted = false
      }, 3000)
    }
  },
  methods: {
    async getNotes() {
      const { data } = await axios.get('http://localhost/api/notes')
      this.notes = data
    }
  },
  beforeMount() {
    this.getNotes()
  }
}
</script>
