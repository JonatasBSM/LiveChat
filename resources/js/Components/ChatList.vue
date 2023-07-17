<template>
    <div class="chat-list">
      <div v-for="chat in chatList" :key="chat.id" class="flex items-center p-3 border-b border-gray-300 hover:bg-gray-100" @click="selectChannel(chat.id)">
        <div class="mr-4">
          <img :src="chat.partners.icon" :alt="getPartnerName(chat.partners)" class="w-12 h-12 rounded-full">
        </div>
        <div>
          <h4 class="text-lg font-semibold">{{ getPartnerName(chat.partners) }}</h4>
          <p class="text-gray-500">{{ chat.preview }}</p>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {

      props: {
          chats: {
              type: Array
          }
      },

      watch: {
          chats: {
              immediate: true,

              handler(val) {
                  this.chatList = val
                  this.selected = this.chatList[0] ?? null
                  if(this.selected)
                    this.selectChannel(this.selected.id)
              }
          }
      },

    data() {
      return {
        chatList: [],
        selected: null
      };
    },

    methods: {
          getPartnerName(partnerList) {
              if(partnerList.length === 0)
                  return ''

              else if (partnerList.length > 1)
                  return ''

              else
                  return partnerList[0].name
          },

          selectChannel(channelId) {
            this.selected = channelId
            this.$emit('selected-channel', channelId)
          }
    }
  };
  </script>
