<template lang="">
    <div class="flex flex-row w-full h-full">

        <div :class=" mobileCheck ? (selectedChannel ? 'hidden' : 'chatList w-full h-full flex flex-col') :
            'flex flex-col chatList w-[30%] h-full border-r-[1px]'">

            <AuthContainer/>
            <ChatList @selected-channel="receiveSelectedChannel"/>

        </div>

        <ChatBox @unselect-channel="receiveUnselectChannelNotification" :selected="selectedChannel" :class="
        mobileCheck ? (!selectedChannel ? 'hidden' : 'w-full') : 'w-[70%] h-full'"/>

    </div>
</template>
<script>

import ChatList from '@/Components/ChatList.vue';
import ChatBox from '@/Components/ChatBox.vue'
import AuthContainer from '@/Components/AuthContainer.vue'

export default {

    components: {
        ChatList,
        ChatBox,
        AuthContainer
    },

    props: {
        chats: {
            type: Array
        }
    },

    data() {
        return {
            chatList: [],
            selectedChannel: null,
            mobileCheck: false
        }
    },

    mounted() {
        this.chatList = this.chats
        this.isMobile()
        window.addEventListener('resize', this.isMobile);
    },

    methods: {
        receiveSelectedChannel(channel) {
            this.selectedChannel = channel
            window.removeEventListener('resize', this.isMobile);
        },

        isMobile() {
            this.mobileCheck = window.innerWidth <= 540 ? true: false
            console.log(this.mobileCheck)
        },

        receiveUnselectChannelNotification() {
            this.selectedChannel = null
        }
    }
}
</script>
<style>
    .chatList {
        border-color: #4a5568;
    }

    .authUserContainer {
        border-color: #4a5568;
    }

</style>
