<template>
<div class="sidenav-container">
  <!-- サイドバーのバックドロップ背景 -->
  <div
    v-if="show"
    class="sidenav-backdrop"
    @click="$emit('close')"></div>
  <!-- トランジション -->
  <transition name="slide-side">
    <!-- サイドナブ -->
    <div
      v-if="show"
      class="sidenav">
      <div
        class="drawer-toggle"
        role="button"
        @click="$emit('close')">
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
      <!-- ハンバーガーメニュー -->
      <ul
        class="nav-list"
        @click="$emit('close')">
        <li class="nav-item"><nuxt-link to="/posts">ブログ</nuxt-link></li>
        <li class="nav-item"><nuxt-link to="/about">About</nuxt-link></li>
        <li class="nav-item"><nuxt-link to="/admin">管理画面</nuxt-link></li>
      </ul>
    </div>
  </transition>
</div>
</template>

<script>
export default {
  name: "TheSidenav",
  props: {
    show: {
      type: Boolean,
      default: false
    }
  }
}</script>