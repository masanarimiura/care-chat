<template>
  <div>
    <HeaderIn></HeaderIn>
    <div class="section">
      <div class="oneArea">
        <div class="onebox">
          <div class="imgArea">
            <img src="https://125naroom.com/wp/wp-content/themes/design125naroom/img/kinoko_pan.png" alt="きのこさん">
          </div>
          <div class="fukiArea">
            <div class="fukidasi">こんにちはー</div>
          </div>
        </div>
        <div class="onebox">
          <div class="imgArea">
            <img src="https://125naroom.com/wp/wp-content/themes/design125naroom/img/kinoko_megane.png" alt="きのこさん">
            </div>
          <div class="fukiArea">
            <div class="fukidasi">こんにちはー、きのこだよー、あたらしいふくかったんだー、いいでしょー、ふふふふふー</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.oneArea {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  max-width: 1024px;
  margin: 50px auto;
  padding: 0 10px;
}
.oneArea .onebox {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
}
.oneArea .onebox:nth-child(even) {
  flex-direction: row-reverse;
  margin-top: 20px;
}
.oneArea .onebox .imgArea {
  width: 16%;
  position: relative;
}
.oneArea .onebox .imgArea img {
  width: 100%;
  max-width: 130px;
  position: absolute;
  top: 0;
}
.oneArea .onebox:nth-child(odd) .imgArea img {
  left: 0;
  padding-right: 30px;
}
.oneArea .onebox:nth-child(even) .imgArea img {
  right: 0;
  padding-left: 30px;
}
.oneArea .onebox .fukiArea {
  width: 63%;
}
.oneArea .onebox .fukidasi {
  width: 100%;
  position: relative;
  padding: 25px;
    background-color: rgb(233, 245, 255);
  font-size: 18px;
  color: #231815;
  border-radius: 12px;
  box-sizing: border-box;
}
.oneArea .onebox .fukidasi::before {
  content: '';
  position: absolute;
  display: block;
  top: 22px;
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 15px 30px 15px 0;
  border-color: transparent #f2f3f7 transparent transparent;
}
.oneArea .onebox:nth-child(odd) .fukidasi::before {
  left: -20px;
}
.oneArea .onebox:nth-child(even) .fukidasi {
  background-color: #fde5e5;
}
.oneArea .onebox:nth-child(even) .fukidasi::before {
  right: -20px;
  border-color: transparent #fde5e5 transparent transparent;
  transform: rotate(180deg);
}
@media screen and (max-width: 1024px) {
  .oneArea .onebox .imgArea img {
    max-width: 70%;
  }
  .oneArea .onebox .fukidasi {
    padding: 15px;
    font-size: 14px;
  }
  .oneArea .onebox .fukidasi::before {
    top: 8px;
  }
}
@media screen and (max-width: 420px) {
  .oneArea {
    margin: 30px auto;
  }
  .oneArea .onebox:nth-child(even) {
    margin-top: 15px;
  }
  .oneArea .onebox .imgArea {
    width: 20%;
  }
  .oneArea .onebox .fukidasi {
    padding: 10px 15px;
    font-size: 12px;
  }
}
</style>