<?php
////////////////////////////////////////////////////////////////////////////
// SCHEDULE MAKER
//
// @author	Ben Russell (benrr101@csh.rit.edu)
//
// @file	roulette.php
// @descrip	Course roulette -- specify a few things to refine the course list
//			then spin the wheel! Get a totally random course each time!
////////////////////////////////////////////////////////////////////////////

require "./inc/header.inc";
?>
<div class="container" ng-controller="SearchCtrl">
	<div class="row">
		<div class="col-md-8">
		<form name="search.form" class="form-horizontal">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row form-horizontal">
						<div class="col-md-4">
							<h2 class="panel-title control-label pull-left">Search Courses</h2>
						</div>
						<div class="col-md-8">
							<div class="control-group">
								<label class="col-sm-6 control-label" for="term">Term:</label>
								<div class="col-sm-6">
									<?= getTermField("state.requestOptions.term"); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-sm-4" for="search.params.college">College:</label>
								<div class="col-sm-8">
						            <select id="search.params.college" name="college" ng-model="search.params.college" ng-options="opt.id as (((opt.id != 'any')?((opt | codeOrNumber) + ((opt.title !='')?' - ' + opt.title: '')): opt.title)) for opt in search.options.colleges" class="mousetrap form-control">
						            </select>
						        </div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-sm-4" for="search.params.department">Department:</label>
								<div class="col-sm-8">
						            <select id="search.params.department" ng-model="search.params.department" ng-options="opt.id as (((opt.id != 'any')?((opt | codeOrNumber) + ((opt.title !='')?' - ' + opt.title: '')): opt.title)) for opt in search.options.departments" name="department" class=" mousetrap form-control">
						            </select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-sm-4" for="search.params.credits">Credit Hours:</label>
								<div class="col-sm-8">
									<input type="text" maxlength="2" size="3" ng-model="search.params.credits" name="credits" class="mousetrap form-control">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-sm-4" for="search.params.level">Level:</label>
								<div class="col-sm-8">
									<select id="search.params.level" ng-model="search.params.level" name="level" class="form-control">
										<option value="any">Any Level</option>
										<option value="beg">Introductory (0 - 300)</option>
										<option value="int">Intermediate (300 - 600)</option>
										<option value="grad">Graduate (&gt;600)</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-sm-4" for="search.params.title">Title:</label>
								<div class="col-sm-8">
									<input type="text" ng-model="search.params.title" name="title" class="mousetrap form-control">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-sm-4" for="search.params.professor">Professor:</label>
								<div class="col-sm-8">
									<input type="text" ng-model="search.params.professor" name="professor" class=" mousetrap form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="search.params.description">Keywords:</label>
						<div class="col-sm-8">
							<input type="text" ng-model="search.params.description" name="description" class="mousetrap form-control" placeholder="(comma delmited)">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4">Days:</label>
						<div class="col-md-8">
							<div dow-select-fields="search.params.days" ng-click="search.params.daysAny = false"></div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4">Times:</label>
						<div class="col-md-8">
							<div class="btn-group">
								<button type="button" ng-class="{'btn-success': search.params.times.morn}" ng-click="search.params.times.morn = !search.params.times.morn; search.params.timesAny = false;" class="btn btn-default">Morning</button>
								<button type="button" ng-class="{'btn-success': search.params.times.aftn}" ng-click="search.params.times.aftn = !search.params.times.aftn; search.params.timesAny = false;" class="btn btn-default">Afternoon</button>
								<button type="button" ng-class="{'btn-success': search.params.times.even}" ng-click="search.params.times.even = !search.params.times.even; search.params.timesAny = false;" class="btn btn-default">Night</button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="online">Course Options:</label>
						<div class="col-sm-8">
							<div class="row">
								<div class="col-sm-4"><button type="button" ng-class="{'btn-success': search.params.online}" ng-click="search.params.online = !search.params.online" class="btn btn-default btn-block">Online <i class="fa fa-square-o" ng-class="{'fa-check-square': search.params.online}"></i></button></div>
								<div class="vert-spacer-static-md visible-xs"></div>
								<div class="col-sm-4"><button type="button" ng-class="{'btn-success': search.params.honors}" ng-click="search.params.honors = !search.params.honors" class="btn btn-default btn-block">Honors <i class="fa fa-square-o" ng-class="{'fa-check-square': search.params.honors}"></i></button></div>
								<div class="vert-spacer-static-md visible-xs"></div>
								<div class="col-sm-4"><button type="button" ng-class="{'btn-success': search.params.offCampus}" ng-click="search.params.offCampus = !search.params.offCampus" class="btn btn-default btn-block">Off Campus <i class="fa fa-square-o" ng-class="{'fa-check-square': search.params.offCampus}"></i></button></div>
							</div>
						</div>
					</div>	
			    </div>
			</div>
		</form>
		<div class="vert-spacer-static-md"></div>
		<div class="btn-group">
					<button type="button" class="btn btn-lg btn-danger pull-left btn-xs-block dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-times"></i> Reset... <span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
<!-- 						<li><a ng-click="resetGenerate()" href="#">Current Form Fields</a></li> -->
						<li><a ng-click="resetState()" href="#">Saved Session</a></li>
					</ul>
				</div>
				<button type="button" class="pull-right btn-lg btn btn-primary btn-xs-block" loading-button="searchStatus" loading-text="Searching..." ng-click="findMatches()" title="Shortcut: Ctrl + Enter"> Search for Courses <i class="fa fa-search fa-flip-horizontal"></i></button>
		<div class="vert-spacer-static-md"></div>
		<div ng-show="!!resultError">
			<div class="alert alert-danger">
				<button type="button" class="close" aria-hidden="true" ng-click="resultError = null"><i class="fa fa-times"></i></button>
				<i class="fa fa-exclamation-circle"></i> {{resultError}}
			</div>
		</div>
		<div id="search_results" ng-show="searchResults.length > 0">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="form-inline clearfix">
						<div class="form-group">
							<div class="form-inline-label"><strong>{{searchResults.length}}</strong> courses found</div>
						</div>
						<div class="pull-right-sm form-group">
							<div class="form-group">
								Results per page:
							</div>
							<div class="form-group">
								<select id="searchPagination-pageSize" class="form-control mousetrap" ng-model="searchPagination.pageSize">
									<option value="3">3</option>
									<option value="5">5</option>
									<option value="10">10</option>
									<option value="15">15</option>
									<option value="20">20</option>
									<option value="50">50</option>
								</select>
							</div>
							<div class="form-group" pagination-controls="searchPagination" pagination-length="searchResults.length"></div>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="course-results-cont row">
						<div class="inline-col col-md-6" ng-repeat="section in searchResults | startFrom:searchPagination.currentPage*searchPagination.pageSize | limitTo:searchPagination.pageSize">
							<ul class="list-group" ng-init="section.selected = false">
								<li class="list-group-item course-info">
									<div class="row">
										<div class="col-sm-8">
											<h4 class="list-group-item-heading">{{($index + 1) + (searchPagination.currentPage*searchPagination.pageSize)}}. {{section.courseNum}}</h4>
											<small>{{section.title}}</small>
											<p class="list-group-item-text label-line ">
												<span class="label label-default" ng-bind-html="section.instructor | RMPUrl"></span>
											</p>
											<div ng-init="parsedTimes = (section.times | parseSectionTimes:true)">
												<div ng-repeat="time in parsedTimes" style="font-size: small">
													{{time.days}} <span style="white-space: nowrap">{{time.start | formatTime}}-{{time.end | formatTime}}</span> <span style="font-style: italic; white-space: nowrap">Location: {{time.location}}</span>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="row">
												<div class="col-xs-12">
													<button type="button" class="btn btn-block" ng-click="courseCart.selection.section.toggleByOrphanedSection(section)" ng-class="{'btn-danger':section.selected, 'btn-success':!section.selected}">
														<i class="fa" ng-class="{'fa-minus':section.selected, 'fa-plus':!section.selected}"></i> <i class="fa fa-shopping-cart"></i>
													</button>
												</div>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="center" pagination-controls="searchPagination" pagination-length="searchResults.length" pagination-callback="scrollToResults()"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4" ng-init="showCourseCart = true">
		<div class="pinned-sizer">
		</div>
			<div pinned course-cart></div>
	</div>
	</div>
</div>
<?
require "inc/footer.inc";
?>
