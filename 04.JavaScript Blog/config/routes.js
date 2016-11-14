const controllers = require('./../controllers')

module.exports = (app) => {
  app.get('/', controllers.home.index)

  app.get('/user/register', controllers.user.registerGet)
  app.post('/user/register', controllers.user.registerPost)

  app.get('/user/login', controllers.user.loginGet)
  app.post('/user/login', controllers.user.loginPost)

  app.get('/user/logout', controllers.user.logout)

  app.get('/article/create', controllers.article.createGet)
  app.post('/article/create', controllers.article.createPost)
  app.get('/article/details/:id', controllers.article.detailsGet)

  app.get('/article/edit/:id', controllers.article.editGet)
  app.post('/article/edit/:id', controllers.article.editPost)

  app.get('/article/delete/:id', controllers.article.deleteGet)
  app.post('/article/delete/:id', controllers.article.deletePost)
}

