function ajax(obj){
  var xhr = new XMLHttpRequest()
  // 如果是get方式，data数据加入到url后面
  if(obj.method == 'get' && obj.data){
    obj.url +='?' + obj.data
  }
  // 设置默认是post方式
  if(obj.method == undefined){
    obj.method = 'post'
  }
  // 初始化
  xhr.open(obj.method,obj.url,true)
  // 发送请求，如果是get方式，直接发送，如果是post方式，需要设置请求表头和传入的数据
  if(obj.method == 'get'){
    xhr.send()
  }else{
    xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
    xhr.send(obj.data)
  }
  // 解析响应数据，解析成功后调用success函数
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4) {
      if(xhr.status == 200){
        obj.success && obj.success(xhr.responseText)
      }else{
        console.log('错误信息：'+xhr.status)
      } 
    }
  }
}