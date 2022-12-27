<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="my-page">
      <div class="my-page_box">
        <ClientMyPage></ClientMyPage>
        <WorkerMyPage></WorkerMyPage>
      </div>
    </div>
  </div>
</template>


<style>
.my-page {
  display: flex;
  justify-content: center;
}
.my-page_box {
  width: 600px;
  height: auto;
  text-align: center;
  border: 2px solid rgb(42, 171, 191);
  background-color: rgb(211, 252, 237);
  border-radius: 10px;
  padding: 30px;
}
</style>