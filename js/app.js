angular.module('checklist-model', [])
.directive('checklistModel', ['$parse', '$compile', function($parse, $compile) {
  function contains(arr, item, comparator) {
    if (angular.isArray(arr)) {
      for (var i = arr.length; i--;) {
        if (comparator(arr[i], item)) {
          return true;
        }
      }
    }
    return false;
  }
  function add(arr, item, comparator) {
    arr = angular.isArray(arr) ? arr : [];
      if(!contains(arr, item, comparator)) {
          arr.push(item);
      }
    return arr;
  }
  function remove(arr, item, comparator) {
    if (angular.isArray(arr)) {
      for (var i = arr.length; i--;) {
        if (comparator(arr[i], item)) {
          arr.splice(i, 1);
          break;
        }
      }
    }
    return arr;
  }
  function postLinkFn(scope, elem, attrs) {
    var checklistModel = attrs.checklistModel;
    attrs.$set("checklistModel", null);
    $compile(elem)(scope);
    attrs.$set("checklistModel", checklistModel);
    var getter = $parse(checklistModel);
    var setter = getter.assign;
    var checklistChange = $parse(attrs.checklistChange);
    var value = attrs.checklistValue ? $parse(attrs.checklistValue)(scope.$parent) : attrs.value;


    var comparator = angular.equals;

    if (attrs.hasOwnProperty('checklistComparator')){
      if (attrs.checklistComparator[0] == '.') {
        var comparatorExpression = attrs.checklistComparator.substring(1);
        comparator = function (a, b) {
          return a[comparatorExpression] === b[comparatorExpression];
        }

      } else {
        comparator = $parse(attrs.checklistComparator)(scope.$parent);
      }
    }
    scope.$watch(attrs.ngModel, function(newValue, oldValue) {
      if (newValue === oldValue) {
        return;
      }
      var current = getter(scope.$parent);
      if (angular.isFunction(setter)) {
        if (newValue === true) {
          setter(scope.$parent, add(current, value, comparator));
        } else {
          setter(scope.$parent, remove(current, value, comparator));
        }
      }

      if (checklistChange) {
        checklistChange(scope);
      }
    });

    function setChecked(newArr, oldArr) {
        scope[attrs.ngModel] = contains(newArr, value, comparator);
    }

    if (angular.isFunction(scope.$parent.$watchCollection)) {
        scope.$parent.$watchCollection(checklistModel, setChecked);
    } else {
        scope.$parent.$watch(checklistModel, setChecked, true);
    }
  }

  return {
    restrict: 'A',
    priority: 1000,
    terminal: true,
    scope: true,
    compile: function(tElement, tAttrs) {
      if ((tElement[0].tagName !== 'INPUT' || tAttrs.type !== 'checkbox')
          && (tElement[0].tagName !== 'MD-CHECKBOX')
          && (!tAttrs.btnCheckbox)) {
        throw 'checklist-model should be applied to `input[type="checkbox"]` or `md-checkbox`.';
      }

      if (!tAttrs.checklistValue && !tAttrs.value) {
        throw 'You should provide `value` or `checklist-value`.';
      }
      if (!tAttrs.ngModel) {
        tAttrs.$set("ngModel", "checked");
      }

      return postLinkFn;
    }
  };
}]);
var attendance = angular.module('attendance', ["checklist-model"]);
attendance.controller('FormController', ['$scope','$http',function($scope,$http) {
	$scope.master 			= {};
	$scope.form_params 		= {};
	$scope.student_data  = {};
	$scope.teacher_data  = {};
	$scope.teacher_student = [];
	$scope.selected_stud = {students: []};
	$scope.update_user = function(user) {
				$scope.master = angular.copy(user);
				console.log($scope.user.sst);
				console.log($scope.user.name);
				$scope.form_params = new FormData();
				$scope.form_params.append('uName',$scope.user.name);
				$scope.form_params.append('uEmail',$scope.user.email);
				$scope.form_params.append('uUsername',$scope.user.username);
				$scope.form_params.append('uPassword',$scope.user.password);
				$scope.form_params.append('uUserType',$scope.user.userType);
				if($scope.user.userType == 'teacher'){
					$scope.form_params.append('uSubject',$scope.user.subject);
				}else {
					$scope.form_params.append('uMath',$scope.user.math);
					$scope.form_params.append('uScience',$scope.user.science);
					$scope.form_params.append('uSst',$scope.user.sst);
					$scope.form_params.append('uEnglish',$scope.user.english);
					$scope.form_params.append('uHindi',$scope.user.hindi);
				}

				$.ajax({
					method  : 'POST',
					url     : 'register.php',
					data    : $scope.form_params,
					processData: false,
					contentType: false

				}).success(function(data) {
					if (!data.success) {
						$("#error_form").show();
						$("#register").show();
						$("#login").hide();
					} else {
						$("#error_form").hide();
						$("#register").hide();
						$("#login").show();
					}
				});
		}

		$scope.login_user = function(user) {
					//$scope.master = angular.copy(user);
					$scope.form_params = new FormData();
					$scope.form_params.append('uUsername',$scope.user.username);
					$scope.form_params.append('uPassword',$scope.user.password);
					$scope.form_params.append('uUserType',$scope.user.userType);

					$.ajax({
						method  : 'POST',
						url     : 'login.php',
						data    : $scope.form_params,
						processData: false,
						contentType: false

					}).success(function(data) {
						if (!data.success) {
							$("#error_form").show();
							$("#register").hide();
							$("#login").show();
						} else {
							if($scope.user.userType == 'student'){
									$scope.$apply(function () {
          					$scope.student_data = data;
        					});
									$("#form-part").hide();
									$("#stud_attendance").show();
									$("#teacher_attendance").hide();
							}else {
								$scope.$apply(function () {
									$scope.teacher_data = data;
								});
								$("#form-part").hide();
								$("#stud_attendance").hide();
								$("#teacher_attendance").show();
							}
						}
					});
			}

			$scope.enter_attendance = function(student) {
						var data	 =  {name: $scope.user.username, students: $scope.selected_stud.students};
						$.ajax({
							method  : 'POST',
							url     : 'update.php',
							data    : JSON.stringify(data),
							processData: false,
							contentType: false

						}).success(function(data) {
								$("#login_form").show();
								$("#stud_attendance").hide();
								$("#teacher_attendance").hide();
						    $("#register").hide();
							if (!data.success) {
								$("#attendance_success").hide();
								$("#attendance_error").show();
							} else {
								$("#attendance_success").show();
								$("#attendance_error").hide();
                $("#logout_btn").show();
							}
						});
				}

}]);
