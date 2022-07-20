'use strict'


const toggleMenu = () => {
  const body = document.querySelector('body')
  const burger = document.querySelector('.burger')
  const menu = document.querySelector('.menu')


  const setActiveClasses = (bool) => {
    if (bool) {
      menu.classList.add('menu--active')
      burger.classList.add('burger--active')
      body.style.overflow = 'hidden'
    } else {
      menu.classList.remove('menu--active')
      burger.classList.remove('burger--active')
      body.style.overflow = 'visible'
    }

  }

  const scrollLinks = () => {
    const links = [...document.querySelectorAll('.menu__list-link')]

    links.forEach(link => {

      link.addEventListener('click', (e) => {
        e.preventDefault()

        setActiveClasses(false)

        const id = link.getAttribute('href')
        const elem = document.querySelector(id)

        elem.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        })

      })

    });

  }

  const togglerMenu = () => {
    burger.addEventListener('click', () => {
      if (!menu.classList.contains('menu--active')) {
        setActiveClasses(true)
      } else {
        setActiveClasses(false)
      }

    })
  }

  togglerMenu()
  scrollLinks()

}


toggleMenu()