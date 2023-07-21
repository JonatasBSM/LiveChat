<template lang="">
    <div class="flex flex-row w-full h-full">

        <FriendListModal @back-to-chatList="receiveBackFromChatList" :class=" mobileCheck ? (mobileScreenState == 'friendList' ? 'w-full h-full flex flex-col' : 'hidden') :
            'flex flex-col chatList w-[30%] h-full border-r-[1px]'"/>

        <div :class=" mobileCheck ? (mobileScreenState == 'chatList' ? 'chatList w-full h-full flex flex-col' : 'hidden') :
            'flex flex-col chatList w-[35%] h-full border-r-[1px]'">

            <AuthContainer @open-button-modal="receiveButtonModalState" />
            <ChatList @selected-channel="receiveSelectedChannel"/>

        </div>

        <ChatBox @unselect-channel="receiveUnselectChannelNotification" :selected="selectedChannel" :class="
        mobileCheck ? (mobileScreenState == 'chatBox' ? 'w-full h-full' :'hidden') : 'w-[65%] h-full'"/>

    </div>
</template>
<script>

import ChatList from '@/Components/ChatList.vue';
import ChatBox from '@/Components/ChatBox.vue'
import AuthContainer from '@/Components/AuthContainer.vue'
import FriendListModal from '@/Components/Modals/FriendListModal.vue'

export default {

    components: {
        ChatList,
        ChatBox,
        AuthContainer,
        FriendListModal
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
            mobileCheck: false,
            mobileScreenState: 'chatList'
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

        },

        receiveUnselectChannelNotification() {
            this.selectedChannel = null
            this.mobileScreenState = 'chatBox'
        },

        receiveButtonModalState(state) {
            this.mobileScreenState = state
        },

        receiveBackFromChatList() {
            this.mobileScreenState = 'chatList'
        },

        getMobileScreenState() {
            return this.mobileScreenState
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
