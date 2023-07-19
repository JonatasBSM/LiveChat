<template lang="">
    <div class="flex flex-row w-full h-full">
        <ChatList @selected-channel="receiveSelectedChannel" class="chatList w-[25%] h-full  border-r-[1px]"/>
        <ChatBox :selected="selectedChannel" class="w-[75%] h-full"/>
    </div>
</template>
<script>

import ChatList from '@/Components/ChatList.vue';
import ChatBox from '@/Components/ChatBox.vue'

export default {

    components: {
        ChatList,
        ChatBox
    },

    props: {
        chats: {
            type: Array
        }
    },

    data() {
        return {
            chatList: [],
            selectedChannel: null
        }
    },

    mounted() {
        this.chatList = this.chats
    },

    methods: {
        receiveSelectedChannel(channel) {
            this.selectedChannel = channel
        }
    }
}
</script>
<style>
    .chatList {
        border-color: #4a5568;
    }
</style>
