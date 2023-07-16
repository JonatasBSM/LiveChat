<template lang="">
    <div class="flex flex-row w-full h-full">
        <ChatList :chats="chatList" class="w-[25%] h-full border-r-4"/>
        <ChatBox :chats="chatList" class="w-[75%] h-full"/>
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
            chatList: []
        }
    },

    mounted() {
        this.chatList = this.chats
    }
}
</script>
<style lang="">

</style>
