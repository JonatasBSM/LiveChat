<template>
  <div class="authUserContainer flex items-center h-16 p-3 border-b-[2px] border-gray-100 bg-gray-900">
    <div class="authUserDetails flex items-center">
      <div class="mr-4">
        <img :src="authUser.icon" :alt="authUser.name" class="w-10 h-10 rounded-full">
      </div>
      <div>
        <h4 class="text-base font-semibold text-white">{{ authUser.name }}</h4>
      </div>
    </div>
    <div class="buttons-container">
      <svg @click="openButtonModal" fill="#FFB000" class="friendListButton" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z"/></svg>
      <svg @click="openButtonModal" fill="#48bb78" class="newChatButton" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM200 344V280H136c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H248v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
    </div>
  </div>
</template>
<script>
export default {
    data() {
        return {
            authUser: this.$page.props.user
        }
    },

    methods: {
      openButtonModal() {
        const button = event.target.closest("svg").getAttribute("class");

        let state = null

        switch(button) {

          case 'friendListButton': {
            state = 'friendList'
            break
          }

          case 'newChatButton': {
            state = 'newChat'
            break
          }

          default: {
            console.log(event.target)
          }

        }

        this.$emit('open-button-modal', state)
      }
    }
}
</script>
<style>

.buttons-container {
  margin-left: auto;
  font-size: 1.5rem/* 24px */;
  line-height: 2rem/* 32px */;
  margin-right: 0.5rem/* 8px */;
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  column-gap: 1rem/* 16px */;
}

.buttons-container svg {
  /* Add shared styles for the buttons here */
  cursor: pointer;
  transition: transform 0.2s ease-in-out, color 0.2s ease-in-out;
}

.buttons-container svg:hover {
  transform: translateY(-1px); /* Move icon up 1px on hover */
  /* Add any other styles you want on hover */
}

/* Add click effect if needed */
.buttons-container svg {
  transform: translateY(0); /* Reset the translation on click */
  /* Add any other styles you want on click */
}

@media (max-width: 540px) {
  /* Media query for screens smaller than 540px */
  .authUserContainer {
    display: flex;
    flex-direction: column;
    height: fit-content;
    align-items: center; /* Center the content horizontally */
    justify-content: center;
    padding-left: 0px;
    padding-right: 0px;
  }

  .authUserDetails {
    width: 100%;
    justify-content: center;
  }

  .buttons-container {
    display: flex;
    margin-top: 1rem; /* Add some spacing between the details and the buttons */
    justify-content: center;
    align-items: center;
    margin-left: 0px;
  }
}
</style>