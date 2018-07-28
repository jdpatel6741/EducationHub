@php
	if(isset($_GET['tab']) && $_GET['tab']!='')
	{
		$tab = $_GET['tab'];
	}
	else {
		exit();
	}
@endphp

@if($tab=="overview")
	<div class="mt-4">
		<ol class="pinned-repos-list mb-4">
			<li class="pinned-repo-item p-3 mb-3 border border-gray-dark rounded-1 public source">
				<span class="pinned-repo-item-content">
					<span class="d-block">
						<a href="" class="text-bold">
							<span class="repo js-repo" title="tenacity">repo name</span>
						</a>
					</span>
					<p class="pinned-repo-desc text-gray text-small d-block mt-2 mb-3">here desp</p>
					<p class="mb-0 f6 text-gray">
						<span class="repo-language-color pinned-repo-meta" style="background-color:#3572A5;"></span>
						language
						<a href="/jd/tenacity/stargazers" class="pinned-repo-meta muted-link">
							<svg class="octicon octicon-star" viewBox="0 0 14 16" version="1.1" width="14" height="16"><path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74L14 6z"></path></svg>
							911
						</a>
						<a href="/jd/tenacity/network" class="pinned-repo-meta muted-link">
							<svg class="octicon octicon-repo-forked" viewBox="0 0 10 16" version="1.1" width="10" height="16"><path fill-rule="evenodd" d="M8 1a1.993 1.993 0 0 0-1 3.72V6L5 8 3 6V4.72A1.993 1.993 0 0 0 2 1a1.993 1.993 0 0 0-1 3.72V6.5l3 3v1.78A1.993 1.993 0 0 0 5 15a1.993 1.993 0 0 0 1-3.72V9.5l3-3V4.72A1.993 1.993 0 0 0 8 1zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3 10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3-10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"></path></svg>
							54
						</a>
					</p>
				</span>
			</li>
			<li class="pinned-repo-item p-3 mb-3 border border-gray-dark rounded-1 public source">
				<span class="pinned-repo-item-content">
					<span class="d-block">
						<a href="" class="text-bold">
							<span class="repo js-repo" title="tenacity">repo name</span>
						</a>
					</span>
					<p class="pinned-repo-desc text-gray text-small d-block mt-2 mb-3">here desp</p>
					<p class="mb-0 f6 text-gray">
						<span class="repo-language-color pinned-repo-meta" style="background-color:#3572A5;"></span>
						language
						<a href="/jd/tenacity/stargazers" class="pinned-repo-meta muted-link">
							<svg class="octicon octicon-star" viewBox="0 0 14 16" version="1.1" width="14" height="16"><path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74L14 6z"></path></svg>
							911
						</a>
						<a href="/jd/tenacity/network" class="pinned-repo-meta muted-link">
							<svg class="octicon octicon-repo-forked" viewBox="0 0 10 16" version="1.1" width="10" height="16"><path fill-rule="evenodd" d="M8 1a1.993 1.993 0 0 0-1 3.72V6L5 8 3 6V4.72A1.993 1.993 0 0 0 2 1a1.993 1.993 0 0 0-1 3.72V6.5l3 3v1.78A1.993 1.993 0 0 0 5 15a1.993 1.993 0 0 0 1-3.72V9.5l3-3V4.72A1.993 1.993 0 0 0 8 1zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3 10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3-10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"></path></svg>
							54
						</a>
					</p>
				</span>
			</li>						
		</ol>
	</div>
@elseif($tab=="repositories")
	<div class="user-profile-repo-filter border-bottom border-gray-dark py-3">
		<form class="TableObject" action="">
			<div class="row">
				<div class="col-md-10">
					@if(isset($_GET['tab']))
						<input name="tab" value="{{ $_GET['tab'] }}" type="hidden">
		      		@endif
		      		<input name="q" class="form-control width-full js-autosearch-field" placeholder="Search repositories…" value="" type="search">
				</div>
				<div class="col-md-2">
		        	<a href="/new" class="btn btn-success ml-3">
		          		<svg class="octicon octicon-repo" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9H3V8h1v1zm0-3H3v1h1V6zm0-2H3v1h1V4zm0-2H3v1h1V2zm8-1v12c0 .55-.45 1-1 1H6v2l-1.5-1.5L3 16v-2H1c-.55 0-1-.45-1-1V1c0-.55.45-1 1-1h10c.55 0 1 .45 1 1zm-1 10H1v2h2v-1h3v1h5v-2zm0-10H2v9h9V1z"></path></svg>
		        		Search
		        	</a>
		        </div>
	    	</div>
		</form>
	</div>

	<div id="user-repositories-list">
		<ul>
			<li class="col-12 d-block width-full py-4 border-bottom public fork">
				<div class="d-inline-block mb-1">
					<h3>
						<a href="/jdpatel6741/learnopencv">learnopencv</a>
					</h3>
					<span class="f6 text-gray mb-1">Forked from <a class="muted-link" href="/spmallick/learnopencv">spmallick/learnopencv</a>
					</span>
				</div>
				<div>
					<p class="col-9 d-inline-block text-gray mb-2 pr-4" itemprop="description">
						Learn OpenCV : C++ and Python Examples
					</p>
					<div class="col-3 float-right text-right">
						<span class="d-inline-block tooltipped tooltipped-s" aria-label="Past year of activity">
						</span>
					</div>
				</div>
				<div class="f6 text-gray mt-2">
					<span class="repo-language-color ml-0" style="background-color:#DA5B0B;"></span>
					<span class="mr-3" itemprop="programmingLanguage">
						Jupyter Notebook
					</span>
					<a class="muted-link mr-3" href="/jdpatel6741/learnopencv/network">
						<svg aria-label="fork" class="octicon octicon-repo-forked" viewBox="0 0 10 16" version="1.1" width="10" height="16" role="img"><path fill-rule="evenodd" d="M8 1a1.993 1.993 0 0 0-1 3.72V6L5 8 3 6V4.72A1.993 1.993 0 0 0 2 1a1.993 1.993 0 0 0-1 3.72V6.5l3 3v1.78A1.993 1.993 0 0 0 5 15a1.993 1.993 0 0 0 1-3.72V9.5l3-3V4.72A1.993 1.993 0 0 0 8 1zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3 10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3-10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"></path></svg>
						1,191
					</a>
					Updated <relative-time datetime="2018-03-25T10:13:11Z" title="Mar 25, 2018, 3:43 PM GMT+5:30">on Mar 25</relative-time>
				</div>
			</li>
			<li class="col-12 d-block width-full py-4 border-bottom public fork">
				<div class="d-inline-block mb-1">
					<h3>
						<a href="/jdpatel6741/Android">Android</a>
					</h3>
					<span class="f6 text-gray mb-1">Forked from <a class="muted-link" href="/hmkcode/Android">hmkcode/Android</a>
					</span>
				</div>
				<div>
					<p class="col-9 d-inline-block text-gray mb-2 pr-4" itemprop="description">Android related examples</p>
					<div class="col-3 float-right text-right">
						<span class="d-inline-block tooltipped tooltipped-s" aria-label="Past year of activity">
						</span>
					</div>
				</div>
				<div class="f6 text-gray mt-2">
					<span class="repo-language-color ml-0" style="background-color:#b07219;"></span>
					<span class="mr-3" itemprop="programmingLanguage">
						Java
					</span>
					<a class="muted-link mr-3" href="/jdpatel6741/Android/network">
						<svg aria-label="fork" class="octicon octicon-repo-forked" viewBox="0 0 10 16" version="1.1" width="10" height="16" role="img"><path fill-rule="evenodd" d="M8 1a1.993 1.993 0 0 0-1 3.72V6L5 8 3 6V4.72A1.993 1.993 0 0 0 2 1a1.993 1.993 0 0 0-1 3.72V6.5l3 3v1.78A1.993 1.993 0 0 0 5 15a1.993 1.993 0 0 0 1-3.72V9.5l3-3V4.72A1.993 1.993 0 0 0 8 1zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3 10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3-10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"></path></svg>
						3,172
					</a>
					Updated <relative-time datetime="2017-10-31T11:12:01Z" title="Oct 31, 2017, 4:42 PM GMT+5:30">on Oct 31, 2017</relative-time>
				</div>
			</li>
		</ul>
	</div>
@elseif($tab=="stars")
@elseif($tab=="followers")
@elseif($tab=="following")
@endif