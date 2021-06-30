<template>
    <nav>
        <img src="/images/gear.svg" class="menu-switch" @click="toggleMenu">
        <transition name="custom-classes-transition"
                    enter-active-class="animation animate__animated animate__fadeInDown"
                    leave-active-class="animation animate__animated animate__fadeOutUp">
            <div class="items" v-show="showMenu">
                <ul>
                    <li @click="toggleMenu">
                        <router-link :to="{name: 'Home'}">Odczytaj dane</router-link>
                    </li>
                    <li @click="toggleMenu">
                        <router-link :to="{name: 'Sensors'}">Dostępne czujniki</router-link>
                    </li>
                    <li v-if="!isAuthenticated" @click="toggleMenu">
                        <router-link :to="{name: 'Login'}">Logowanie</router-link>
                    </li>
                    <li v-if="isAuthenticated">
                        <a @click="logout">{{email}} [Wyloguj]</a>
                    </li>
                </ul>
            </div>
        </transition>
    </nav>
</template>

<script>
import axios from 'axios'

export default {
    name: "Nav",
    data: function () {
        return {
            showMenu: false
        };
    },
    methods: {
        toggleMenu() {
            this.showMenu = !this.showMenu
        },
        logout() {
            axios.get(`api/auth/logout`)
                .then(response => {
                    if (response.data) {
                        this.$store.commit('flushState')
                        if (this.$route.name !== 'Home')
                            this.$router.push({name: 'Home'})
                    }
                })
        }
    },
    computed: {
        isAuthenticated: function () {
            return this.$store.state.isAuthenticated
        },
        email: function () {
            return this.$store.state.email
        }
    }
}
</script>

<style scoped>
nav {
    color: #fff;
    font-family: Avenir, Helvetica, Arial, sans-serif;
    z-index: 5;
}

.items {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
}

.items ul {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: center;
}

.items ul li {
    margin: 0 .75rem;
}

.menu-switch {
    position: absolute;
    top: 1rem;
    right: 1rem;
    transition: 1s;
    z-index: 11;
    cursor: pointer;
}

.menu-switch:hover {
    transform: rotate(360deg);
}

@media (max-width: 768px) {
    .items {
        position: absolute;
        top: 0;
        left: 0;
        background-color: #3f3f3f;
        height: 100vh;
        z-index: 10;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .items ul {
        display: block;
        text-align: center;
    }

    .items ul li {
        margin: 1rem;
    }
}

</style>
