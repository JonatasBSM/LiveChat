<template>
    <div class="chat-screen flex flex-col">
      <div class="message-container">
        <div v-for="message in messages" :key="message.id" class="message bg-gray-200 p-4 mb-4 w-fit h-fit max-w-1/2 flex flex-col">
          <div class="inline-block w-fit message-content font-semibold">{{ message.text }}</div>
          <div class="inline block w-fit message-sender text-gray-500">{{ message.sender }}</div>
        </div>
      </div>
      <div class="flex-grow"></div>
      <div class="input-container bg-gray-100 flex items-center py-2 px-4">
        <input v-model="newMessage" class="message-input flex-grow p-2 rounded-l-md" placeholder="Type your message...">
        <button @click="sendMessage" class="send-button bg-green-500 text-white py-2 px-4 rounded-r-md">Send</button>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        messages: [
          {
            id: 1,
            text: 'Hello!',
            sender: 'John Doe',
          },
          {
            id: 2,
            text: 'Hi there!',
            sender: 'Jane Smith',
          },
          // Add more message objects as needed
        ],
        newMessage: '',
      };
    },
    methods: {
      sendMessage() {
        if (this.newMessage.trim() !== '') {
          const message = {
            id: this.messages.length + 1,
            text: this.newMessage,
            sender: 'You',
          };
          this.messages.push(message);
          this.newMessage = '';
        }
      },
    },
  };
  </script>
