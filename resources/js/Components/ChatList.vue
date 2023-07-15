<template>
    <div class="chat-list">
      <div v-for="chat in chats" :key="chat.id" class="flex items-center p-3 border-b border-gray-300 hover:bg-gray-100">
        <div class="mr-4">
          <img :src="chat.avatar" :alt="chat.name" class="w-12 h-12 rounded-full">
        </div>
        <div>
          <h4 class="text-lg font-semibold">{{ chat.name }}</h4>
          <p class="text-gray-500">{{ chat.preview }}</p>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        chats: [
          {
            id: 1,
            name: 'John Doe',
            avatar: 'https://example.com/avatar1.jpg',
            preview: 'Hey, how are you?',
          },
          {
            id: 2,
            name: 'Jane Smith',
            avatar: 'https://example.com/avatar2.jpg',
            preview: 'Just finished the project!',
          },
          // Add more chat objects as needed
        ],
      };
    },
  };
  </script>
