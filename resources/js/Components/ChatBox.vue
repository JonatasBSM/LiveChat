<template>
    <div class="custom-bg-color chat-screen flex flex-col">
      <div class="message-container flex flex-col">
        <div v-if="channel" v-for="message in channel.messages" :key="message.id" :class="['message bg-green-100 p-4 ml-4 mb-4 w-fit h-fit max-w-1/2 flex flex-col rounded', message.sender === 'You' ? 'self-end' : '']">
          <div class="message-content font-semibold">{{ message.content }}</div>
          <div class="message-sender text-gray-500">{{ message.sender }}</div>
        </div>
      </div>
      <div class="flex-grow"></div>
      <div class="input-container bg-gray-100 flex items-center py-2 px-4">
        <input v-model="newMessage" class="message-input flex-grow p-2 rounded-l-md h-full" placeholder="Type your message...">
        <button @click="sendMessage" class="send-button bg-green-500 text-white py-2 px-4 rounded-r-md h-full">Send</button>
      </div>
    </div>
</template>

  <script>
import axios from 'axios';

  export default {

      props: {
          selected: {
              type: Object
          }
      },

      watch: {
          selected: {
              immediate: true,

              handler(val) {
                this.channel = val
                console.log(this.channel)
              }
          }
      },

    data() {
      return {
        newMessage: '',

        channel: null
      };
    },
    methods: {
      sendMessage() {
        console.log(this.$page.props.user.id)
        if (this.newMessage.trim() !== '') {
          const message = {
            channel_id: this.channel.id,
            content: this.newMessage,
            user_id: this.$page.props.user.id
          };

          axios.post('/pusher/broadcast', {
            ...message
          })
          this.newMessage = '';
        }

      },
    },
  };
  </script>

  <style>
  .custom-bg-color {
    background-color: #E2E8F0; /* Light blue color */
  }

  .message {
    background-color: #C6F6D5; /* Light green color */
    transition: all 0.2s ease; /* Smooth transition duration */
  }

  .send-button {
    transition: all 0.2s ease; /* Smooth transition duration */
  }

  .message:hover, .send-button:hover {
    background-color: #A7ECC9; /* Lighter green color on hover */
    transform: translate(-1px, -1px); /* Slight movement on hover */
  }

  .self-end {
    align-self: flex-end;
    margin-right: 1rem;
  }
  </style>
