<template>

    <div v-if="partner" class="custom-bg-color chat-screen flex flex-col border-none">
        <div class="partner-container flex items-center p-3 h-16 bg-gray-900 border-b-[2px] ">

            <div class="backIconDiv mr-4">
                <svg @click="unselectChannel" class="w-10 h-10" fill="white" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><polygon points="352,128.4 319.7,96 160,256 160,256 160,256 319.7,416 352,383.6 224.7,256 "/></svg>
            </div>

            <div class="mr-4">
                <img src="" class="w-10 h-10 rounded-full">
            </div>
            <div>
                <h4 class="text-lg font-semibold text-white">{{ partner.name }}</h4>
            </div>
        </div>


        <div ref="messageContainer" class="message-container flex flex-col flex-grow">

        </div>

        <div class="input-container bg-gray-800 h-16 flex items-center p-3">
            <input
                v-model="newMessage"
                class="message-input flex-grow p-2 rounded-l-md h-full bg-gray-900 text-white"
                placeholder="Type your message..."
            >
            <button @click="createChannel" class="send-button bg-green-500 text-white py-2 px-4 rounded-r-md h-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                </svg>
            </button>
        </div>
    </div>


    <div v-else class="custom-bg-color chat-screen flex flex-col border-none">
        <div class="partner-container flex items-center p-3 h-16 bg-gray-900 border-b-[2px] ">

            <div class="backIconDiv mr-4">
                <svg @click="unselectChannel" class="w-10 h-10" fill="white" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><polygon points="352,128.4 319.7,96 160,256 160,256 160,256 319.7,416 352,383.6 224.7,256 "/></svg>
            </div>

            <div class="mr-4">
                <img src="" class="w-10 h-10 rounded-full">
            </div>
            <div>
                <h4 v-if="channel" class="text-lg font-semibold text-white">{{ getPartnerName(channel.partners) }}</h4>
            </div>
        </div>

        <div ref="messageContainer" class="message-container flex flex-col flex-grow">
            <div
                v-if="channel"
                v-for="message in channel.messages"
                :key="message.id"
                :class="['message bg-gray-700 p-4 ml-4 mb-4 w-fit h-fit max-w-1/2 flex flex-col rounded', message.user_id === authUser.id ? 'self-end' : '']"
            >
                <div class="message-content font-semibold text-white">{{ message.content }}</div>
                <div class="message-sender text-gray-400">{{ message.sender }}</div>
                <div class="message-time text-gray-400 text-xs text-right">{{ message.created_at }}</div>
            </div>
        </div>
        <div class="input-container bg-gray-800 h-16 flex items-center p-3">
            <input
                v-model="newMessage"
                class="message-input flex-grow p-2 rounded-l-md h-full bg-gray-900 text-white"
                placeholder="Type your message..."
            >
            <button @click="sendMessage" class="send-button bg-green-500 text-white py-2 px-4 rounded-r-md h-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        selected: {
            type: Object,
        },

        partnerProp: {
            type: Object
        }
    },

    watch: {
        selected: {
            immediate: true,

            handler(val) {
                this.channel = val;
            },
        },

        partnerProp: {
            handler(val) {
                this.partner = val
                console.log(val)
            }
        }
    },

    data() {
        return {
            newMessage: '',
            channel: null,
            authUser: this.$page.props.user,
            partner: null
        };
    },

    methods: {
        sendMessage() {
            if (this.newMessage.trim() !== '') {
                const message = {
                    channel_id: this.channel.id,
                    content: this.newMessage,
                    user_id: this.$page.props.user.id,
                };

                axios.post('/pusher/broadcast', {
                    ...message,
                }).then(() => {
                    const messageContainer = this.$refs.messageContainer;
                    messageContainer.scrollTop = messageContainer.scrollHeight;
                });
                this.newMessage = '';
            }
        },

        getPartnerName(partnerList) {
            if (partnerList.length === 0) return '';
            else if (partnerList.length > 1) return '';
            else return partnerList[0].name;
        },

        unselectChannel() {
            this.partner = null
            this.$emit('unselect-channel')
        },

        createChannel() {
            if (this.newMessage.trim() !== '') {
                const message = {
                    content: this.newMessage,
                    user_id: this.$page.props.user.id,
                    partner_id: this.partner.id
                };

                axios.post('/pusher/broadcast/new-channel', {
                    ...message,
                }).then((response) => {
                    this.channel = response.channel
                    const messageContainer = this.$refs.messageContainer;
                    messageContainer.scrollTop = messageContainer.scrollHeight;
                });
                this.newMessage = '';
            }
        }
    },
};
</script>

<style>
.custom-bg-color {
    background-color: #2d3748; /* Dark blue-gray background */
}

.message {
    background-color: #4a5568; /* Dark gray message background */
    transition: all 0.2s ease; /* Smooth transition duration */
}

.send-button {
    transition: all 0.2s ease; /* Smooth transition duration */
}

.message:hover,
.send-button:hover {
    background-color: #718096; /* Lighter gray on hover */
    transform: translate(-1px, -1px); /* Slight movement on hover */
}

.self-end {
    align-self: flex-end;
    margin-right: 1rem;
}

.partner-container {
    border-color: #4a5568;
}

.message-container {
    overflow-y: auto;
}



.message-content {
    color: #ffffff; /* White message content text color */
}

.message-sender {
    color: #a0aec0; /* Gray message sender text color */
}

.input-container {
    background-color: #2c3848; /* Dark blue-gray input container background */
}

.message-input {
    color: #ffffff; /* White message input text color */
}

.send-button {
    background-color: #48bb78; /* Dark green send button background */
}

@media (min-width: 541px) {
    .backIconDiv {
        display: none;
    }
}
</style>
