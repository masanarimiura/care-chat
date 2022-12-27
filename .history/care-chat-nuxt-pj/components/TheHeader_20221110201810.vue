<template>
<div class="header-container">
  <header class="the-header">
    <!-- ハンバーガー(768px以上で非表示) -->
    <TheSideNavToggle @toggle="$emit('sidenavToggle')" />
    <div class="logo">
      <nuxt-link to="/">タイトル</nuxt-link>
    </div>
    <!-- スペース -->
    <div class="spacer"></div>
    <!-- ナブアイテム(768px未満で非表示) -->
    <div class="navigation-items">
      <ul class="nav-list">
        <li class="nav-item"><nuxt-link to="/posts">ブログ</nuxt-link></li>
        <li class="nav-item"><nuxt-link to="/about">アバウト</nuxt-link></li>
        <li class="nav-item"><nuxt-link to="/admin">管理画面</nuxt-link></li>
      </ul>
    </div>
  </header>
</div>
</template>