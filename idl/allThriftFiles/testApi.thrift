
namespace php service.test

include "base.thrift"
include "test.thrift"

service TestAPI
{
	/** 卡牌详情 */
	test.TestResp testInfo(1: test.testReq req) throws (1: base.TestException err);
}

