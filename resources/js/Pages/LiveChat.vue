<template lang="">
    <div class="flex flex-row w-full h-full">

        <FriendListModal @screen-state="receiveScreenState" @mobile-screen-state="receiveMobileScreenState" @chat-box-state="receivePartnerForNewChat" :class=" mobileCheck ? (mobileScreenState == 'newChat' ? 'w-full h-full flex flex-col' : 'hidden') :
            (ScreenState != 'chatList' ? 'flex flex-col chatList w-[35%] h-full border-r-[1px]' : 'hidden')"/>

        <div :class=" mobileCheck ? (mobileScreenState == 'chatList' ? 'chatList w-full h-full flex flex-col' : 'hidden') :
            (ScreenState != 'newChat' ? 'flex flex-col chatList w-[35%] h-full border-r-[1px]' : 'hidden')">

            <AuthContainer @screen-state="receiveScreenState" @mobile-screen-state="receiveMobileScreenState" />
            <ChatList :key="channelReload" @send-chat-list="getChatList" @selected-channel="receiveSelectedChannel"/>

        </div>

        <ChatBox :partnerProp="channelPartner" @add-new-channel="addNewChannel" @unselect-channel="receiveUnselectChannelNotification" :selected="selectedChannel" :class="
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

    data() {
        return {
            chatList: [],
            selectedChannel: null,
            mobileCheck: false,
            mobileScreenState: 'chatList',
            ScreenState: 'chatList',
            channelPartner: null,
            channelReload: 0
        }
    },

    mounted() {
        this.isMobile()
        window.addEventListener('resize', this.isMobile);
    },

    methods: {
        receiveSelectedChannel(channel) {
            this.selectedChannel = channel
            this.mobileScreenState = 'chatBox'
            this.channelPartner = null
            window.removeEventListener('resize', this.isMobile);
        },

        isMobile() {
            this.mobileCheck = window.innerWidth <= 540 ? true: false

        },

        receiveUnselectChannelNotification() {
            this.selectedChannel = null
            this.channelPartner = null
            this.mobileScreenState = 'chatList'

        },

        receiveMobileScreenState(state) {
            this.mobileScreenState = state
        },

        receiveScreenState(state) {
            this.ScreenState = state
        },

        receivePartnerForNewChat(user) {
            this.channelPartner = user
            console.log('asda')
        },

        addNewChannel() {
            console.log('uepa')
            this.channelReload++
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
