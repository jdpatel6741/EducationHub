<!DOCTYPE html>
<html lang="en">
<head>
    <title>SourceCode</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/sourcecode/style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .checked {
            color: orange;
        }
    </style>
</head>
<body>

<div class="container">

    <br>
    <div class="row">
        <div class="col-md-6">
            <h3 class="public ">
                <span class="glyphicon glyphicon-inbox"></span>
                <span class="author"><a class="url fn" rel="author" href="/Gregwar">Gregwar</a></span> /
                <strong itemprop="name"><a data-pjax="#js-repo-pjax-container"
                                           href="/Gregwar/Captcha">Captcha</a></strong>

            </h3>
        </div>

        <div class="col-md-6">
            <ul class="pagehead-actions pull-right">
                <li>
                    <a href="/watch" class="btn btn-sm btn-with-count tooltipped tooltipped-n">
                        <svg class="octicon octicon-eye" viewBox="0 0 16 16" version="1.1" width="16" height="16"
                             aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M8.06 2C3 2 0 8 0 8s3 6 8.06 6C13 14 16 8 16 8s-3-6-7.94-6zM8 12c-2.2 0-4-1.78-4-4 0-2.2 1.8-4 4-4 2.22 0 4 1.8 4 4 0 2.22-1.78 4-4 4zm2-4c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"></path>
                        </svg>
                        Watch
                    </a>
                    <a class="social-count">
                        42
                    </a>

                </li>

                <li>
                    <a href="/star" class="btn btn-sm btn-with-count tooltipped tooltipped-n">
                        <svg class="octicon octicon-star" viewBox="0 0 14 16" version="1.1" width="14" height="16"
                             aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74L14 6z"></path>
                        </svg>
                        Star
                    </a>

                    <a class="social-count js-social-count">
                        841
                    </a>

                </li>

                <li>
                    <a href="/Codes" class="btn btn-sm btn-with-count tooltipped tooltipped-n">
                        <svg class="octicon octicon-code" viewBox="0 0 14 16" version="1.1" width="14" height="16"
                             aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M9.5 3L8 4.5 11.5 8 8 11.5 9.5 13 14 8 9.5 3zm-5 0L0 8l4.5 5L6 11.5 2.5 8 6 4.5 4.5 3z"></path>
                        </svg>
                        Codes
                    </a>

                    <a class="social-count">
                        173
                    </a>
                </li>
            </ul>
        </div>
    </div>


    <div class="row">
        <div class="repository-content ">


            <hr>

            <div class="js-repo-meta-container">
                <div class="repository-meta mb-0  js-repo-meta-edit js-details-container ">
                    <div class="repository-meta-content col-11 mb-1">
          <span class="col-11 text-gray-dark mr-2" itemprop="about">
            PHP Captcha library
          </span>
                    </div>

                </div>
            </div>


            <div class="overall-summary overall-summary-bottomless">
                <div class="stats-switcher-viewport js-stats-switcher-viewport">
                    <div class="stats-switcher-wrapper">
                        <ul class="numbers-summary">
                            <li class="commits">
                                <a data-pjax="" href="/Gregwar/Captcha/commits/master">
                                    <svg class="octicon octicon-history" viewBox="0 0 14 16" version="1.1" width="14"
                                         height="16" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M8 13H6V6h5v2H8v5zM7 1C4.81 1 2.87 2.02 1.59 3.59L0 2v4h4L2.5 4.5C3.55 3.17 5.17 2.3 7 2.3c3.14 0 5.7 2.56 5.7 5.7s-2.56 5.7-5.7 5.7A5.71 5.71 0 0 1 1.3 8c0-.34.03-.67.09-1H.08C.03 7.33 0 7.66 0 8c0 3.86 3.14 7 7 7s7-3.14 7-7-3.14-7-7-7z"></path>
                                    </svg>
                                    <span class="num text-emphasized">
                107
              </span>
                                    commits
                                </a>
                            </li>
                            <li>
                                <a data-pjax="" href="/Gregwar/Captcha/branches">
                                    <svg class="octicon octicon-git-branch" viewBox="0 0 10 16" version="1.1" width="10"
                                         height="16" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M10 5c0-1.11-.89-2-2-2a1.993 1.993 0 0 0-1 3.72v.3c-.02.52-.23.98-.63 1.38-.4.4-.86.61-1.38.63-.83.02-1.48.16-2 .45V4.72a1.993 1.993 0 0 0-1-3.72C.88 1 0 1.89 0 3a2 2 0 0 0 1 1.72v6.56c-.59.35-1 .99-1 1.72 0 1.11.89 2 2 2 1.11 0 2-.89 2-2 0-.53-.2-1-.53-1.36.09-.06.48-.41.59-.47.25-.11.56-.17.94-.17 1.05-.05 1.95-.45 2.75-1.25S8.95 7.77 9 6.73h-.02C9.59 6.37 10 5.73 10 5zM2 1.8c.66 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2C1.35 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2zm0 12.41c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm6-8c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"></path>
                                    </svg>
                                    <span class="num text-emphasized">
              1
            </span>
                                    branch
                                </a>
                            </li>

                            <li>
                                <a href="/Gregwar/Captcha/releases">
                                    <svg class="octicon octicon-tag" viewBox="0 0 14 16" version="1.1" width="14"
                                         height="16" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M7.685 1.72a2.49 2.49 0 0 0-1.76-.726H3.48A2.5 2.5 0 0 0 .994 3.48v2.456c0 .656.269 1.292.726 1.76l6.024 6.024a.99.99 0 0 0 1.402 0l4.563-4.563a.99.99 0 0 0 0-1.402L7.685 1.72zM2.366 7.048A1.54 1.54 0 0 1 1.9 5.925V3.48c0-.874.716-1.58 1.58-1.58h2.456c.418 0 .825.159 1.123.467l6.104 6.094-4.702 4.702-6.094-6.114zm.626-4.066h1.989v1.989H2.982V2.982h.01z"></path>
                                    </svg>
                                    <span class="num text-emphasized">
              22
            </span>
                                    releases
                                </a>
                            </li>

                            <li>
                                <a href="/Gregwar/Captcha/graphs/contributors">
                                    <svg class="octicon octicon-organization" viewBox="0 0 16 16" version="1.1"
                                         width="16" height="16" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M16 12.999c0 .439-.45 1-1 1H7.995c-.539 0-.994-.447-.995-.999H1c-.54 0-1-.561-1-1 0-2.634 3-4 3-4s.229-.409 0-1c-.841-.621-1.058-.59-1-3 .058-2.419 1.367-3 2.5-3s2.442.58 2.5 3c.058 2.41-.159 2.379-1 3-.229.59 0 1 0 1s1.549.711 2.42 2.088C9.196 9.369 10 8.999 10 8.999s.229-.409 0-1c-.841-.62-1.058-.59-1-3 .058-2.419 1.367-3 2.5-3s2.437.581 2.495 3c.059 2.41-.158 2.38-1 3-.229.59 0 1 0 1s3.005 1.366 3.005 4z"></path>
                                    </svg>
                                    <span class="num text-emphasized">
      20
    </span>
                                    contributors
                                </a>

                            </li>
                            <li>
                                <a href="/Gregwar/Captcha/blob/master/LICENSE">
                                    <svg class="octicon octicon-law" viewBox="0 0 14 16" version="1.1" width="14"
                                         height="16" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M7 4c-.83 0-1.5-.67-1.5-1.5S6.17 1 7 1s1.5.67 1.5 1.5S7.83 4 7 4zm7 6c0 1.11-.89 2-2 2h-1c-1.11 0-2-.89-2-2l2-4h-1c-.55 0-1-.45-1-1H8v8c.42 0 1 .45 1 1h1c.42 0 1 .45 1 1H3c0-.55.58-1 1-1h1c0-.55.58-1 1-1h.03L6 5H5c0 .55-.45 1-1 1H3l2 4c0 1.11-.89 2-2 2H2c-1.11 0-2-.89-2-2l2-4H1V5h3c0-.55.45-1 1-1h4c.55 0 1 .45 1 1h3v1h-1l2 4zM2.5 7L1 10h3L2.5 7zM13 10l-1.5-3-1.5 3h3z"></path>
                                    </svg>
                                    MIT
                                </a>
                            </li>
                        </ul>

                        <div class="repository-lang-stats">
                            <ol class="repository-lang-stats-numbers">
                                <li>
                                    <a href="/Gregwar/Captcha/search?l=php"
                                       data-ga-click="Repository, language stats search click, location:repo overview">
                                        <span class="color-block language-color"
                                              style="background-color:#4F5D95;"></span>
                                        <span class="lang">PHP</span>
                                        <span class="percent">100.0%</span>
                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="repository-lang-stats-graph js-toggle-lang-stats" title="Click for language details"
                 data-ga-click="Repository, language bar stats toggle, location:repo overview">
                <span class="language-color" aria-label="PHP 100.0%" style="width:100.0%; background-color:#4F5D95;"
                      itemprop="keywords">PHP</span>
            </div>


            <div class="file-navigation in-mid-page d-flex flex-items-start">
                <div class="breadcrumb flex-auto">

                </div>

                <div class="BtnGroup">
                    <a href="/Gregwar/Captcha/find/master" class="btn btn-sm empty-icon ">
                        Favorite
                    </a>
                    <a class="btn btn-sm btn-primary">
                        Download
                        <span class="dropdown-caret"></span>
                    </a>
                </div>
            </div>


            <div class="commit-tease js-details-container Details d-flex">


            </div>


            <div class="file-wrap">

                <a class="d-none js-permalink-shortcut" data-hotkey="y"
                   href="/Gregwar/Captcha/tree/a96d8dffc80d6213958bd19fbdef1555e8b63ca3">Permalink</a>

                <table class="files js-navigation-container js-active-navigation-container" data-pjax="">


                    <tbody>
                    <tr class="warning include-fragment-error">
                        <td class="icon">
                            <svg class="octicon octicon-alert" viewBox="0 0 16 16" version="1.1" width="16" height="16"
                                 aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M8.893 1.5c-.183-.31-.52-.5-.887-.5s-.703.19-.886.5L.138 13.499a.98.98 0 0 0 0 1.001c.193.31.53.501.886.501h13.964c.367 0 .704-.19.877-.5a1.03 1.03 0 0 0 .01-1.002L8.893 1.5zm.133 11.497H6.987v-2.003h2.039v2.003zm0-3.004H6.987V5.987h2.039v4.006z"></path>
                            </svg>
                        </td>
                        <td class="content" colspan="3">Failed to load latest commit information.</td>
                    </tr>

                    <tr class="js-navigation-item" aria-selected="false">
                        <td class="icon">
                            <svg class="octicon octicon-file-directory" viewBox="0 0 14 16" version="1.1" width="14"
                                 height="16" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M13 4H7V3c0-.66-.31-1-1-1H1c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1V5c0-.55-.45-1-1-1zM6 4H1V3h5v1z"></path>
                            </svg>
                            <img width="16" height="16" class="spinner" alt=""
                                 src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif">
                        </td>
                        <td class="content">
                            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title="demo"
                                                                              id="fe01ce2a7fbac8fafaed7c982a04e229-cf86bf6fdac170bc098f35a3fe67855cffee25e7"
                                                                              href="/Gregwar/Captcha/tree/master/demo">demo</a></span>
                        </td>
                        <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="refactor autoload" class="message"
                     href="/Gregwar/Captcha/commit/0ec8e404f88261fde13783b0e87236d589b90607">refactor autoload</a>
            </span>
                        </td>
                        <td class="age">
                            <span class="css-truncate css-truncate-target"><time-ago datetime="2017-11-28T12:25:01Z"
                                                                                     title="Nov 28, 2017, 5:55 PM GMT+5:30">7 months ago</time-ago></span>
                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>


            <div id="readme" class="readme boxed-group clearfix announce instapaper_body md">
                <h3>
                    <svg class="octicon octicon-book" viewBox="0 0 16 16" version="1.1" width="16" height="16"
                         aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M3 5h4v1H3V5zm0 3h4V7H3v1zm0 2h4V9H3v1zm11-5h-4v1h4V5zm0 2h-4v1h4V7zm0 2h-4v1h4V9zm2-6v9c0 .55-.45 1-1 1H9.5l-1 1-1-1H2c-.55 0-1-.45-1-1V3c0-.55.45-1 1-1h5.5l1 1 1-1H15c.55 0 1 .45 1 1zm-8 .5L7.5 3H2v9h6V3.5zm7-.5H9.5l-.5.5V12h6V3z"></path>
                    </svg>
                    README.md
                </h3>

                <article class="markdown-body entry-content" itemprop="text">



                </article>
            </div>


        </div>
    </div>

    <div class="row">
        <hr>
        Join Source Code Today
    </div>

</div>

</body>
</html>
