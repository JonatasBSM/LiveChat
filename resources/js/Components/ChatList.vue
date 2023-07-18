<template>
    <div class="chat-list">
      <div v-for="chat in chatList" :key="chat.id" class="flex items-center  h-16 p-3 border-b-[1px] border-gray-100  hover:bg-gray-100" @click="selectChannel(chat.id)">
        <div class="mr-4">
          <img :src="chat.partners.icon" :alt="getPartnerName(chat.partners)" class="w-12 h-12 rounded-full">
        </div>
        <div>
          <h4 class="text-lg font-semibold">{{ getPartnerName(chat.partners) }}</h4>
          <p class="text-gray-500">{{ chat.preview.content }}</p>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {

    data() {
      return {
        chatList: [],
        selected: null
      };
    },

    mounted() {
        this.chatList = this.$page.props.chats
        this.listenChannels(this.chatList)
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
            let channel = this.chatList.find((chat) => chat.id == channelId)
            this.$emit('selected-channel', channel)
          },

          listenChannels(chatList) {

              if(chatList.length == 0)
                return

              chatList.map((chat) => {
                  const channel = Echo.channel('LiveChatChannel'+chat.id)
                  channel.listen('MessageSentEvent', (event) => {

                    chat.messages.push(event.message)
                    chat.preview = event.message
                  })
              })
          }
    }
  };
  </script>
