<template>
  <div class="modal-container bg-gray-900">
    <div class="modal-content flex flex-col">

      <div @click="sendBackToChatList" class="back-button pb-1">
        <svg fill="white" xmlns="http://www.w3.org/2000/svg" class="text-2xl" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
      </div>

      <div id="masqueico" class="search-existent-user-container flex items-center p-3 border-b border-gray-700">
        <input
          v-model="searchQuery"
          @input="searchUsers"
          placeholder="Search a user"
          class="flex-grow p-2 bg-gray-800 text-white rounded-l-md focus:outline-none"
        />
        <button
          @click="addUser"
          class="search-button rounded-r-md"
        >
          Search
        </button>
      </div>

      <div  class="user-list-container">
        <ul class="search-results">
          <li
            v-for="user in filteredUsers"
            :key="user.id"
            @click="openNewChannel(user)"
            class="cursor-pointer hover:bg-gray-800 flex items-center justify-between p-3 border-b border-gray-700 text-white"
          >
            <span>{{ user.name }}</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      searchQuery: "",
      usersList: [

      ],
        authUser: this.$page.props.auth.user
    };
  },
  computed: {
    filteredUsers() {

      return this.usersList.filter((user) =>
        user.name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
  },
  methods: {
    searchUsers() {
      if(!this.searchQuery) {
        this.usersList = []
        return
      }
      axios.get('/users/show', {
          params: {
              name: this.searchQuery,
              auth_id: this.authUser.id
          }
      }).then(response => {
          this.usersList = response.data.usersList
      })
    },
    addUser() {

      console.log("Adding new friend:", this.searchQuery);
      this.searchQuery = "";
    },
    addUserToSelected(user) {
      // Implement adding the selected friend to the list of selected friends
      // For example, push it into the selectedFriends array.
      console.log("Adding friend to selected list:", user.name);
    },

    sendBackToChatList() {
      this.$emit('mobile-screen-state', 'chatList')
      this.$emit('screen-state', 'chatList')
    },

      openNewChannel(user) {
        this.$emit('mobile-screen-state', 'chatBox')
        this.$emit('chat-box-state', user)
      }
  },
};
</script>

<style>
/* Add your modal styles here */
.modal-container {
  /* Your modal container styles */
}

.modal-content {
  /* Your modal content styles */
}

.new-user-container,
.existent-user-container {
  /* Add any custom styles for the containers */
}

/* Adjust the styles for the back SVG */
.back-button {
  margin-left: auto;
  padding-top: 1.2rem;
  padding-right: 1.2rem;
}

/* Adjust the styles for the search button */
.search-button {
  background-color: #48BB78;
  font-size: 1rem; /* Revert the font size to the original */
  line-height: 1.5rem; /* Revert the line height to the original */
  padding: 0.5rem 1rem; /* Adjust padding for the button */
  transition: background-color 0.2s ease-in-out;
}

/* Hover effect for the back SVG */
.back-button:hover svg {
  transform: scale(1.1); /* Scale up on hover */
  color: #FFB000; /* Change color on hover */
  cursor: pointer; /* Show pointer cursor on hover */
  transition: transform 0.2s ease-in-out, color 0.2s ease-in-out;
}

/* Hover effect for the search button */
.search-button:hover {
  background-color: #34D399; /* Change background color on hover */
  cursor: pointer; /* Show pointer cursor on hover */
  transform: scale(1.05); /* Scale up on hover */
  transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out; /* Add transition */
}

.masqueico:focus {
  -webkit-appearance: none;
  outline: 0;
}
</style>
