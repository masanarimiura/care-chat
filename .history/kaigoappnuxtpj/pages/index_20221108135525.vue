<template>
  <div class="register">
    <TopBar></TopBar>
    <div class="register__inner">
      <div class="register__box">
        <p>新規登録</p>
        <br />
      </div>
    </div>
  </div>
</template>

<script>
</script>

<style>
.register__inner{
  display: flex;
  justify-content: center;
}
.register__box{
  width: 500px;
  background-color: #fff;
  border-radius: 10px;
  padding: 50px;
  text-align: center;
}
p{
  color: #000;
  font-weight: bold;
}
input{
  margin: 10px;
  width: 400px;
  height: 30px;
}
.register__btn{
  margin: 20px;
  width: 100px;
  border-radius: 20px;
  padding-top: 10px;
  padding-bottom: 10px;
  background: #5a419d;
  color: #fff;
  border: 3px outset #401092;
  cursor: pointer;
}
.error {
  color: red;
}
</style>