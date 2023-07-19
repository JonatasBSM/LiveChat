<template>
    <div class="chat-list">

        <div class="flex items-center h-16 p-3 border-b-[2px] border-gray-100 bg-gray-900">
            <div class="mr-4">
                <img :src="authUser.icon" :alt="getPartnerName(authUser.name)" class="w-10 h-10 rounded-full">
            </div>
            <div>
                <h4 class="text-base font-semibold text-white">{{ authUser.name }}</h4>
            </div>
        </div>

        <div v-for="chat in chatList" :key="chat.id" class="chatDiv flex items-center h-16 p-3 border-b-[1px] border-gray-100 hover:bg-gray-800 cursor-pointer" @click="selectChannel(chat.id)">
            <div class="mr-4">
                <img :src="chat.partners.icon" :alt="getPartnerName(chat.partners)" class="w-12 h-12 rounded-full">
            </div>
            <div>
                <h4 class="text-lg font-semibold text-white">{{ getPartnerName(chat.partners) }}</h4>
                <p class="text-gray-400">{{ truncateText(chat.preview.content, 15) }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return {
            chatList: [],
            selected: null,
            authUser: this.$page.props.user
        };
    },

    mounted() {
        this.chatList = this.$page.props.chats
        this.listenChannels(this.chatList)
    },

    methods: {
        getPartnerName(partnerList) {
            if (partnerList.length === 0)
                return '';
            else if (partnerList.length > 1)
                return '';
            else
                return partnerList[0].name;
        },

        selectChannel(channelId) {
            this.selected = channelId
            let channel = this.chatList.find((chat) => chat.id == channelId)
            this.$emit('selected-channel', channel)
        },

        listenChannels(chatList) {
            if (chatList.length == 0)
                return

            chatList.map((chat) => {
                const channel = Echo.private('LiveChatChannel' + chat.id)

                channel.listen('MessageSentEvent', (event) => {
                    chat.messages.push(event.message)
                    chat.preview = event.message
                })
            })
        },

        truncateText(text, limit) {
            if (text.length <= limit) {
                return text;
            } else {
                return text.slice(0, limit) + '...';
            }
        }
    }
};
</script>

<style>
.chat-list {
    background-color: #2d3748; /* Dark blue-gray background */
}

.chat-list > div {
    border-color: #4a5568; /* Dark gray border color */
}

.chatDiv:hover {
    background-color: #4a5568; /* Dark blue-gray background on hover */
}

.chat-list h4, .chat-list p {
    color: #fff; /* White text color */
}

.chat-list p {
    color: #a0aec0; /* Gray text color for preview content */
}
</style>
