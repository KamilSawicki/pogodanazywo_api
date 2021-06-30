<template>
    <div id="app">
        <Nav></Nav>
        <div class="content">
            <transition name="custom-classes-transition"
                        enter-active-class="animation animate__animated animate__fadeIn delay"
                        leave-active-class="animation animate__animated animate__fadeOut">
                <router-view/>
            </transition>
        </div>
    </div>
</template>

<style>
@font-face {
    font-family: SF;
    src: url("../assets/FontsFree-Net-SFCompactDisplay-Regular.ttf");
}
:root {
    --temperature: #b5225a;
    --humidity: #0c28de;
    --pressure: #0ba535;
}
body {
    margin: 0;
    background-color: #000;
    font-family: SF, serif;
    font-size: 1.25em;
    overflow-y: scroll;
    color: #bbb;
}
.content {
    margin: 70px auto 0;
    max-width: 1200px;
    min-height: calc(100vh - 70px);
}
.temperature {
    color: var(--temperature)
}
.humidity {
    color: var(--humidity)
}
.pressure {
    color: var(--pressure)
}
.box {
    background-color: rgb(64, 64, 64);
    border-radius: 20px;
    margin: 0.3rem;
    padding: .5rem;
    box-shadow: 0 0 3px #999999;
}
a {
    color: unset;
    text-decoration: none;
}
.delay {
    animation-delay: .5s;
}
.animation {
    animation-duration: .3s;
}
.form {
    width: 30vw;
}
.form-control {
    display: block;
    width: calc(100% - .5rem - 3rem);
    background-color: unset;
    border: none;
    border-bottom: 1px solid #999;
    color: #bbb;
    font-size: 1.25em;
    margin-bottom: 0.5rem;
    padding: .5rem .5rem .5rem 3rem;
}
.form-control:focus {
    outline: none;
}
.btn {
    background-color: #999999;
    border: none;
    font-size: 1.25em;
    width: 100%;
    padding: .5rem;
}
.btn:focus {
    outline: none;
}
.alert {
    color: #cc0000;
    display: block
}
@media (max-width: 768px) {
    .form {
        width: 90vw;
    }
}
</style>

<script>
import Nav from "./components/Nav";

export default {
    components: {Nav}
}
</script>
